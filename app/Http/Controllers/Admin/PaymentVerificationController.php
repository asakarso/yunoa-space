<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Consultation;
use Illuminate\Http\Request;

class PaymentVerificationController extends Controller
{
    /**
     * Menampilkan daftar semua pembayaran yang menunggu verifikasi.
     */
    public function index()
    {
        // Ambil semua pembayaran dengan status yang relevan
        $pendingPayments = Payment::where('status', 'menunggu verifikasi')
                                  ->with('user', 'doctor') // Eager load relasi untuk efisiensi
                                  ->latest() // Tampilkan yang terbaru di atas
                                  ->paginate(10); // Gunakan paginate agar tidak berat jika data banyak

        return view('admin.payments.index', compact('pendingPayments'));
    }

    /**
     * Menyetujui sebuah pembayaran.
     * Menggunakan Route Model Binding (Payment $payment) untuk kemudahan.
     */
    public function approve(Payment $payment)
    {
        // 1. Pastikan pembayaran memang sedang menunggu verifikasi
        if ($payment->status !== 'menunggu verifikasi') {
            return back()->with('error', 'Pembayaran ini sudah diproses sebelumnya.');
        }

        // 2. Ubah status pembayaran menjadi 'berhasil'
        $payment->status = 'berhasil';
        $payment->save();

        // 3. Cari konsultasi terkait dan aktifkan
        $consultation = Consultation::where('id_user', $payment->user_id)
                                    ->where('id_dokter', $payment->doctor_id)
                                    ->where('status', 'menunggu')
                                    ->latest('id_konsul')
                                    ->first();
        
        if ($consultation) {
            $consultation->status = 'aktif';
            $consultation->save();
        }

        return back()->with('success', 'Pembayaran telah berhasil disetujui!');
    }
}