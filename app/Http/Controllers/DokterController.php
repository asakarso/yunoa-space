<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Diagnosis;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    // Menampilkan dashboard dokter
    public function index()
    {
        $user = Auth::user();

        // Gunakan 'id_user' dari user yang login untuk cari doctor
        $doctor = Doctor::where('id', $user->id_user)->first();

        if (!$doctor) {
            abort(403, 'Anda bukan dokter yang terdaftar.');
        }

        return view('dokter.dashboard');
    }
    public function dashboard()
{
    return view('dokter.dashboard');
}

    // Menampilkan halaman chat untuk konsultasi tertentu
    public function showChat($id_konsul)
    {
        $konsultasi = Consultation::with(['user', 'chatMessages'])
            ->where('id_konsul', $id_konsul)
            ->where('id_dokter', Auth::user()->id_user) // sesuaikan dengan id_user
            ->firstOrFail();

        return view('chat.index', compact('konsultasi'));
    }

    // Menandai konsultasi sebagai selesai
    public function selesai($id_konsul)
    {
        $konsultasi = Consultation::findOrFail($id_konsul);

        if ($konsultasi->id_dokter != Auth::user()->id_user) {
            abort(403);
        }

        $konsultasi->status = 'selesai';
        $konsultasi->save();

        return redirect()->route('dokter.diagnosa.form', $id_konsul)->with('success', 'Konsultasi ditandai selesai.');
    }

    // Form input diagnosa
    public function showFormDiagnosa($id_konsul)
    {
        $konsultasi = Consultation::with('user')->findOrFail($id_konsul);

        if ($konsultasi->id_dokter != Auth::user()->id_user) {
            abort(403);
        }

        return view('dokter.form_diagnosa', compact('konsultasi'));
    }

    // Simpan hasil diagnosa
    public function simpanDiagnosa(Request $request, $id_konsul)
    {
        $request->validate([
            'hasil_diagnosa' => 'required|string|max:5000'
        ]);

        $konsultasi = Consultation::findOrFail($id_konsul);

        if ($konsultasi->id_dokter != Auth::user()->id_user) {
            abort(403);
        }

        $konsultasi->laporan_hasil = $request->hasil_diagnosa;
        $konsultasi->save();

        return redirect()->route('dokter.dashboard')->with('success', 'Diagnosa berhasil disimpan.');
    }
    public function patients()
{
    $userId = auth()->id();

    // Cari record doctor berdasarkan user_id
    $doctor = \App\Models\Doctor::where('user_id', $userId)->first();

    if (!$doctor) {
        abort(403, 'Anda bukan dokter yang terdaftar.');
    }

    // Ambil konsultasi berdasarkan doctor.id
    $konsultasi_list = \App\Models\Consultation::with(['user', 'pesan_terakhir'])
        ->where('id_dokter', $doctor->id)
        ->orderByDesc('updated_at')
        ->get();

    return view('dokter.patients', compact('konsultasi_list'));
}


    public function profil()
{
    $user = Auth::user();
    $doctor = Doctor::where('id_user', $user->id)->firstOrFail();

    return view('dokter.profil', compact('doctor', 'user'));
}
public function chat($id_konsul)
{
   $userId = auth()->id();
    $doctor = \App\Models\Doctor::where('user_id', $userId)->firstOrFail();

    $konsultasi = Consultation::with(['user', 'pesan_terakhir', 'pesans'])
                    ->where('id_konsul', $id_konsul)
                    ->where('id_dokter', $doctor->id)
                    ->firstOrFail();

    $pasien = $konsultasi->user;
    $pesans = $konsultasi->pesans;

    return view('dokter.chatdoc', compact('konsultasi', 'pasien', 'pesans'));
}
public function sendChat(Request $request)
{
    $request->validate([
        'id_penerima' => 'required|exists:users,id_user',
        'id_konsultasi' => 'required|exists:consultations,id_konsul',
        'pesan' => 'required|string|max:1000',
    ]);

    Pesan::create([
        'id_pengirim' => auth()->user()->id_user,
        'id_penerima' => $request->id_penerima,
        'id_konsultasi' => $request->id_konsultasi,
        'pesan' => $request->pesan,
    ]);

    return redirect()->route('dokter.chat', $request->id_konsultasi);
}
public function akhiriKonsultasi(Request $request)
{
    $request->validate([
        'id_konsultasi' => 'required|exists:consultations,id_konsul',
        'laporan_hasil' => 'required|string'
    ]);

    $konsultasi = Consultation::findOrFail($request->id_konsultasi);
    $konsultasi->status = 'selesai';
    $konsultasi->laporan_hasil = $request->laporan_hasil;
    $konsultasi->save();

    return redirect()->route('dokter.dashboard.patients')->with('success', 'Konsultasi berhasil diakhiri.');
}


}
