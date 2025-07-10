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

        return redirect()->route('chat', $request->id_konsultasi)->with('success', 'Pesan berhasil dikirim.');
    }

    public function showChat($consultId)
    {
        $konsultasi = Consultation::with(['user', 'dokter'])->findOrFail($consultId);
        
        $user = auth()->user();

        if ($user->id_user === $konsultasi->id_dokter) {
            $dokter = $user;
            $lawanBicara = $konsultasi->user;
        } else {
            $dokter = $konsultasi->dokter;
            $lawanBicara = $konsultasi->dokter;
        }
        
        $pesans = Pesan::where('id_konsultasi', $consultId)
                       ->orderBy('created_at')
                       ->get();

        return view('chat', compact('pesans', 'konsultasi', 'dokter', 'lawanBicara'));
    }
}