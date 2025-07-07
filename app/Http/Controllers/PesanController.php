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
        $konsultasi_list = Consultation::where('id_user', $userId)
            ->orWhere('id_dokter', $userId)
            ->with('dokter', 'user') 
            ->orderByDesc('updated_at') 
            ->get();

        foreach ($konsultasi_list as $konsultasi) {
            $pesanTerakhir = Pesan::where('id_konsultasi', $konsultasi->id_konsul)
                ->orderByDesc('created_at')
                ->first();

            $konsultasi->pesan_terakhir = $pesanTerakhir;
        }

        return view('counselingList', compact('konsultasi_list'));
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

    public function showChat($consultId)
    {
        $konsultasi = Consultation::findOrFail($consultId);
        $dokter = User::findOrFail($konsultasi->id_dokter);

        $user = auth()->user()->id_user;

        $pesans = Pesan::whereIn('id_pengirim', [$user, $konsultasi->id_dokter])
            ->whereIn('id_penerima', [$user, $konsultasi->id_dokter])
            ->orderBy('created_at')
            ->get();

        return view('chat', compact('pesans', 'konsultasi', 'dokter'));
    }
}
