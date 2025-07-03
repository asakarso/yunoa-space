<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function showList($userId)
    {
        // Ambil semua ID lawan bicara (pengirim/penerima) dari pesan-pesan user ini
        $userIds = Pesan::where('id_pengirim', $userId)
            ->pluck('id_penerima')
            ->merge(
                Pesan::where('id_penerima', $userId)->pluck('id_pengirim')
            )
            ->unique()
            ->filter(fn($id) => $id != $userId)
            ->values();

        $users = User::whereIn('id_user', $userIds)->get();

        // Tambahkan pesan terakhir ke masing-masing user
        foreach ($users as $user) {
            $pesanTerakhir = Pesan::where(function ($q) use ($userId, $user) {
                $q->where('id_pengirim', $userId)
                    ->where('id_penerima', $user->id_user);
            })
                ->orWhere(function ($q) use ($userId, $user) {
                    $q->where('id_pengirim', $user->id_user)
                        ->where('id_penerima', $userId);
                })
                ->orderByDesc('created_at')
                ->first();

            $user->pesan_terakhir = $pesanTerakhir ? $pesanTerakhir->pesan : null;
            $user->waktu_pesan_terakhir = $pesanTerakhir ? $pesanTerakhir->created_at : null;
        }

        return view('consultation', compact('users'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'id_penerima' => 'required|exists:users,id_user',
            'pesan' => 'required|string',
            'id_konsultasi' => 'required|exists:consultations,id_konsul'
        ]);

        Pesan::create([
            'id_pengirim' => auth()->user()->id_user,
            'id_penerima' => $request->id_penerima,
            'pesan' => $request->pesan,
            'id_konsultasi' => $request->id_konsultasi
        ]);

        return redirect()->route('chat', $request->id_penerima)->with('success', 'Pesan berhasil dikirim.');
    }

    public function showChat($userId)
    {
        $dokter = User::findOrFail($userId);

        // Ambil konsultasi terbaru (jika ingin satu)
        $konsultasi = Consultation::where('id_user', auth()->user()->id_user)
            ->where('id_dokter', $userId)
            ->orderBy('tanggal_konsultasi') // <- opsional, jika banyak data
            ->first(); // <- eksekusi query dan ambil hasil

        // Ambil percakapan diurutkan berdasarkan waktu
        $pesans = Pesan::where(function ($q) use ($userId) {
            $q->where('id_pengirim', auth()->user()->id_user)
                ->where('id_penerima', $userId);
        })->orWhere(function ($q) use ($userId) {
            $q->where('id_pengirim', $userId)
                ->where('id_penerima', auth()->user()->id_user);
        })
            ->orderBy('created_at') // <- ini yang wajib untuk urutan chat
            ->get();

        return view('chat', compact('pesans', 'konsultasi', 'dokter'));
    }
}
