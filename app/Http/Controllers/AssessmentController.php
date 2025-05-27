<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AssesmentQuestion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    public function showQuestion(){
        $pertanyaan = AssesmentQuestion::pluck('pertanyaan')->toArray();
        return view('test', compact('pertanyaan'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'userId' => 'required|exists:users,id_user',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'waktuSubmit' => 'required',
            'jawaban' => 'required|array',
            'skor' => 'required|numeric'
        ]);

        $assessmentId = DB::table('assessments')->insertGetId([
            'id_user' => $validated['userId'],
            'tanggal_assess' => $validated['tanggal'],
            'waktu_assess' => $validated['waktu'],
            'jam_selesai' => $validated['waktuSubmit'],
            'skor_hasil' => $validated['skor'],
        ]);

        foreach($validated['jawaban'] as $index => $userChoice){
            DB::table('user_answers')->insert([
                'id_assess' => $assessmentId,
                'id_question' => $index + 1,
                'user_choice' => $userChoice,
            ]);
        }

        session()->flash('assessment_score', $validated['skor']);
        session()->flash('assessment_id_result', $assessmentId); 

        $redirectUrl = url('self-assessment/result');

        return response()->json([
            'message' => 'Assessment berhasil disimpan.',
            'score' => $validated['skor'],
            'assessment_id' => $assessmentId,
            'redirect_url' => $redirectUrl 
        ]);
    }

    public function showResult()
    {
        $currentScore = session('assessment_score');
        $currentAssessmentId = session('assessment_id_result');
        $userId = Auth::id();

        $totalAttempts = 0;
        $latestScore = null; 
        $scoreToDisplay = null; 

        if ($userId) {
            $totalAttempts = DB::table('assessments')->where('id_user', $userId)->count();

            $lastAssessmentFromDb = DB::table('assessments')->where('id_user', $userId)->orderBy('tanggal_assess', 'desc') ->orderBy('id_assess', 'desc')->first();

            if ($lastAssessmentFromDb) {
                $latestScoreFromDb = $lastAssessmentFromDb->skor_hasil;
            }

            if (!is_null($currentScore)) {
                $scoreToDisplay = $currentScore;
            } elseif ($lastAssessmentFromDb) {
                $scoreToDisplay = $latestScoreFromDb;
            } else {
                return redirect()->url('self-assessment')  ->with('error', 'Tidak ada hasil assessment yang dapat ditampilkan.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat hasil assessment.');
        }

        return view('result', [ 
            'score' => $scoreToDisplay, 
            'totalAttempts' => $totalAttempts,   
            'latestScoreFromDb' => $latestScore, 
        ]);
    }
}