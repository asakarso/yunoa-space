<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\Consultation;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class CounselingController extends Controller
{
    public function showDoctors(Request $request)
    {
        $query = User::whereHas('roles', function($q) {
            $q->where('nama_role', 'dokter');
        })
        ->with('doctor');

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_user', 'like', '%' . $request->search . '%');
        }

        $doctors = $query->get();
        return view('consultation', compact('doctors'));
    }

    public function showPayment($doctor_id)
    {
        $user = Auth::user();

        // Ganti: cek total_konseling di tabel users
        if ($user->total_konseling < 1) {
            return redirect('/')->with('error', 'Kamu belum pernah melakukan konsultasi gratis.');
        }

        // Ambil data dokter dari tabel users
        $doctor = User::findOrFail($doctor_id);

        return view('counseling.payment', compact('doctor'));
    }

    public function processPayment(Request $request, $doctor_id)
    {
        $request->validate([
            'method' => 'required|string'
        ]);

        $user = Auth::user();
        $doctor = User::findOrFail($doctor_id);

        Payment::create([
            'user_id' => $user->id_user,           // sesuaikan dengan kolom di tabel kamu
            'doctor_id' => $doctor->id_user,       // sesuaikan dengan kolom di tabel kamu
            'amount' => $doctor->consultation_price,
            'method' => $request->method,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('chat', $doctor_id)
    ->with('success', 'Pembayaran berhasil disimpan.');
    }

    public function reviewForm($consultId, Request $request)
    {
        $isEdit = $request->query('isEdit', false);
        $konsultasi = Consultation::findOrFail($consultId);
        $dokter = User::findOrFail($konsultasi->id_dokter);
        $review = Review::where('id_konsul', $consultId)->first();

        return view('user.review', compact('konsultasi', 'dokter', 'review', 'isEdit'));
    }

    public function storeReview(Request $request, $consultId)
    {
        $user = Auth::user();

        Review::create([
            'id_user' => $user->id_user,
            'id_dokter' => $request->dokterId,
            'id_konsul' => $consultId,
            'tanggal_review' => now()->format('Y-m-d'),
            'waktu_review' => now()->format('H:i:s'),
            'rating' => $request->rating,
            'deskripsi_review' => $request->deskripsi_review,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('review', $consultId);
    }

    public function editReview(Request $request, $reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->update([
            'tanggal_review' => now()->format('Y-m-d'),
            'waktu_review' => now()->format('H:i:s'),
            'rating' => $request->rating,
            'deskripsi_review' => $request->deskripsi_review,
            'updated_at' => now(),
        ]);

        return redirect()->route('review', $review->id_konsul);
    }
}
