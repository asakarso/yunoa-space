<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan Auth di-import

class PesanController extends Controller
{
    /**
     * Menampilkan daftar semua konsultasi pengguna.
     * Logika ini sekarang berbasis status konsultasi, bukan riwayat pesan.
     */
    public function showList($userId)
    {
        // Pastikan user yang login hanya bisa melihat list konsultasinya sendiri
        if (Auth::id() != $userId) {
            abort(403, 'Unauthorized action.');
        }
        
        // 1. Ambil semua konsultasi yang sudah AKTIF (disetujui admin)
        // Ini adalah konsultasi yang bisa di-chat oleh pengguna.
        $activeConsultations = Consultation::where('id_user', $userId)
                                       ->where('status', 'aktif')
                                       ->with('doctor.profile') // Eager load info dokter dan profilnya jika ada
                                       ->latest('id_konsul') // Urutkan berdasarkan yang terbaru
                                       ->get();

        // 2. Ambil semua konsultasi yang masih PENDING
        // Ini adalah konsultasi yang masih menunggu pembayaran atau verifikasi admin.
        $pendingConsultations = Consultation::where('id_user', $userId)
                                       ->whereIn('status', ['menunggu', 'menunggu verifikasi'])
                                       ->with('doctor.profile')
                                       ->latest('id_konsul')
                                       ->get();
        
        // 3. (Opsional) Ambil konsultasi yang sudah SELESAI
        $completedConsultations = Consultation::where('id_user', $userId)
                                       ->where('status', 'selesai')
                                       ->with('doctor.profile')
                                       ->latest('id_konsul')
                                       ->get();

        // Menggabungkan data pesan terakhir ke setiap konsultasi aktif
        foreach ($activeConsultations as $consultation) {
            $lastMessage = Pesan::where('id_konsultasi', $consultation->id_konsul)
                                ->latest()
                                ->first();
            
            // Tambahkan properti baru ke objek konsultasi
            $consultation->last_message = $lastMessage ? $lastMessage->pesan : 'Klik untuk memulai percakapan...';
            $consultation->last_message_time = $lastMessage ? $lastMessage->created_at : $consultation->updated_at;
        }


        // 4. Kirim semua data ke view
        return view('counselingList', compact(
            'activeConsultations', 
            'pendingConsultations',
            'completedConsultations'
        ));
    }

    public function send(Request $request)
    {
        $request->validate([
            'id_penerima' => 'required|exists:users,id_user',
            'pesan' => 'required|string',
            'id_konsultasi' => 'required|exists:consultations,id_konsul'
        ]);

        Pesan::create([
            'id_pengirim' => auth()->id(),
            'id_penerima' => $request->id_penerima,
            'pesan' => $request->pesan,
            'id_konsultasi' => $request->id_konsultasi
        ]);

        return back()->with('success', 'Pesan berhasil dikirim.');
    }

    public function showChat($userId)
    {
        $dokter = User::findOrFail($userId);
        $currentUser = Auth::user();

        // Ambil konsultasi yang AKTIF dan TERBARU dengan dokter ini
        $konsultasi = Consultation::where('id_user', $currentUser->id_user)
            ->where('id_dokter', $userId)
            ->where('status', 'aktif') // Pastikan hanya konsultasi aktif yang bisa di-chat
            ->latest('id_konsul')
            ->firstOrFail(); // Gagal jika tidak ada konsultasi aktif

        // Ambil percakapan yang terkait dengan konsultasi spesifik ini
        $pesans = Pesan::where('id_konsultasi', $konsultasi->id_konsul)
            ->orderBy('created_at')
            ->get();

        return view('chat', compact('pesans', 'konsultasi', 'dokter'));
    }
}