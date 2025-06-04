<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Payment;
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;

class CounselingController extends Controller
{
    public function showPayment($doctor_id)
    {
        $user = Auth::user();

        // Validasi: user harus sudah pernah konsultasi gratis (consultation dummy)
        $hasConsulted = Consultation::where('user_id', $user->id)
            ->where('is_free', true)
            ->where('status', 'completed')
            ->exists();

        if (! $hasConsulted) {
            return redirect('/homepage')->with('error', 'Kamu belum pernah melakukan konsultasi gratis.');
        }

        $doctor = Doctor::findOrFail($doctor_id);

        return view('counseling.payment', compact('doctor'));
    }

    public function processPayment(Request $request, $doctor_id)
    {
        $request->validate([
            'method' => 'required|string'
        ]);

        $user = Auth::user();
        $doctor = Doctor::findOrFail($doctor_id);

        Payment::create([
            'user_id' => $user->id,
            'doctor_id' => $doctor->id,
            'amount' => $doctor->price,
            'method' => $request->method,
            'status' => 'pending'
        ]);

        return redirect('/homepage')->with('success', 'Pembayaran berhasil disimpan.');
    }
}
