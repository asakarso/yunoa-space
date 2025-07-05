<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class CounselingController extends Controller
{
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
}
