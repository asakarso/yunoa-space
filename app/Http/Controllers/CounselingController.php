<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;

class CounselingController extends Controller
{
    /**
     * Menampilkan halaman pembayaran.
     * Logika ini memeriksa apakah sudah ada pembayaran yang tertunda ('pending') atau menunggu verifikasi.
     */
    public function showPayment($doctor_id)
    {
        $user = Auth::user();
        $doctor = User::findOrFail($doctor_id);

        // Jika user punya pembayaran yang masih 'menunggu verifikasi' dengan dokter ini,
        // langsung arahkan ke halaman 'verifying' untuk mencegah pembayaran ganda.
        $isVerifying = Payment::where('user_id', $user->id_user)
                                ->where('doctor_id', $doctor->id_user)
                                ->where('status', 'menunggu verifikasi')
                                ->exists();

        if ($isVerifying) {
            return redirect()->route('counseling.verifying');
        }

        // Cari pembayaran yang masih 'pending' untuk dilanjutkan
        $payment = Payment::where('user_id', $user->id_user)
                          ->where('doctor_id', $doctor->id_user)
                          ->where('status', 'pending')
                          ->latest()
                          ->first();
        
        $selectedMethod = $payment ? $payment->method : null;

        return view('counseling.payment', compact('doctor', 'selectedMethod', 'payment'));
    }

    /**
     * Memproses pemilihan metode pembayaran awal.
     * Menggunakan updateOrCreate untuk menghindari duplikasi data.
     */
    public function processPayment(Request $request, $doctor_id)
    {
        $request->validate([
            'method' => 'required|string|in:transfer,qris,va',
            'bank' => 'required_if:method,transfer|string|nullable'
        ]);

        $user = Auth::user();
        $doctor = User::findOrFail($doctor_id);

        // Cari atau buat entri pembayaran.
        Payment::updateOrCreate(
            ['user_id' => $user->id_user, 'doctor_id' => $doctor->id_user, 'status' => 'pending'],
            [
                'amount' => $doctor->consultation_price ?? 0,
                'method' => $request->method,
                'payment_detail' => $request->bank 
            ]
        );
        
        // Cari atau buat juga entri konsultasi (jika belum ada yang 'menunggu')
        Consultation::firstOrCreate(
            ['id_user' => $user->id_user, 'id_dokter' => $doctor->id_user, 'status' => 'menunggu'],
            [
                'tanggal_konsultasi' => now()->toDateString(),
                'jam_mulai' => now()->format('H:i:s'),
                'jam_selesai' => now()->addMinutes(30)->format('H:i:s'),
            ]
        );

        return redirect()->route('counseling.payment', $doctor->id_user);
    }

    /**
     * Menangani upload bukti pembayaran dan mengubah status untuk diverifikasi admin.
     */
    public function verifyPayment(Request $request)
    {
        // 1. Validasi: pastikan ada file bukti yang diupload
        $request->validate([
            'doctor_id' => 'required|exists:users,id_user',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = Auth::user();
        $doctorId = $request->doctor_id;

        // 2. Cari pembayaran 'pending' yang akan diverifikasi
        $payment = Payment::where('user_id', $user->id_user)
            ->where('doctor_id', $doctorId)
            ->where('status', 'pending')
            ->latest()
            ->first();

        if (!$payment) {
            return redirect()->route('homepage')->with('error', 'Sesi pembayaran tidak ditemukan atau sudah kedaluwarsa.');
        }

        // 3. Proses dan simpan file yang di-upload
        if ($request->hasFile('payment_proof')) {
            // Simpan file ke folder 'storage/app/public/proofs'
            $path = $request->file('payment_proof')->store('proofs', 'public');
            $payment->payment_proof = $path;
        }

        // 4. Ubah status pembayaran menjadi 'menunggu verifikasi'
        $payment->status = 'menunggu verifikasi';
        $payment->save();

        // Konsultasi tetap 'menunggu' sampai admin menyetujui.
        
        // 5. Arahkan pengguna ke halaman "Menunggu Verifikasi"
        return redirect()->route('counseling.verifying')
            ->with('success', 'Bukti pembayaran berhasil diupload. Mohon tunggu verifikasi dari admin.');
    }
}