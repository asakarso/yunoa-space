<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AssesmentQuestion;
use App\Models\Assessment;
use App\Models\Consultation;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    public function assessmentAttempt()
    {
        $userId = Auth::user()->id_user;
        $assess = Assessment::where('id_user', $userId)->orderBy('tanggal_assess', 'desc')->first();
        // $konsultasi = Consultation::where('id_user', $userId)->get();

        if ($assess) {
            return redirect()->route('result', $assess->id_assess);
        } else {
            return view('assessment');
        }
    }

    public function showQuestion()
    {
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

        foreach ($validated['jawaban'] as $index => $userChoice) {
            DB::table('user_answers')->insert([
                'id_assess' => $assessmentId,
                'id_question' => $index + 1,
                'user_choice' => $userChoice,
            ]);
        }

        return response()->json([
            'success' => true,
            'score' => $validated['skor'],
            'redirect_url' => route('result', $assessmentId),
        ]);
    }

    public function showResult($assessId)
    {
        $assess = Assessment::findOrFail($assessId);
        $score = $assess->skor_hasil;
        $userId = Auth::id();

        $totalAttempts = 0;

        if ($userId) {
            $totalAttempts = DB::table('assessments')->where('id_user', $userId)->count();
        } else {
            return redirect()->route('login')->with('error', 'You have to login.');
        }

        return view('result', [
            'score' => $score,
            'totalAttempts' => $totalAttempts,
        ]);
    }
}
