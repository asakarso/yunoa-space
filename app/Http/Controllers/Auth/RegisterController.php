<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

public function register(Request $request)
{
    // Validasi input (sudah benar)
    $validatedData = $request->validate([
        'nama_user' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan', 
        'nomor_telepon' => 'required|string|max:20',
        'email_user' => 'required|string|email|unique:users,email_user',
        'pass_user' => 'required|string|min:6|confirmed',
        'aktivitas_utama' => 'nullable|string|max:255',
        'tujuan_menggunakan' => 'nullable|string|max:255',
        'jam_tidur' => 'nullable|date_format:H:i',
    ]);

        try {
            // Mulai transaksi database
            DB::beginTransaction();
            
            // Cek ID role 'pengguna'
            $rolePenggunaId = DB::table('roles')->where('nama_role', 'pengguna')->value('id_role');

            if (!$rolePenggunaId) {
                // Melempar exception agar ditangkap oleh blok catch
                throw new \Exception('Role "pengguna" tidak ditemukan di database.');
            }

            // Buat data di tabel 'users' terlebih dahulu
            $user = User::create([
                'nama_user' => $validatedData['nama_user'],
                'email_user' => $validatedData['email_user'],
                'foto_profil' => 'default.png',
                'pass_user' => Hash::make($validatedData['pass_user']),
                'nomor_telepon' => $validatedData['nomor_telepon'],
                'total_konseling' => 0,
            ]);

            // Buat data profil yang terhubung dengan user baru
            $user->profile()->create([
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'aktivitas_utama' => $validatedData['aktivitas_utama'],
                'tujuan_menggunakan' => $validatedData['tujuan_menggunakan'],
                'jam_tidur' => $validatedData['jam_tidur'],
            ]);

            DB::table('user_roles')->insert([
                'id_user' => $user->id_user,
                'id_role' => $rolePenggunaId,
            ]);
            
            // Simpan semua perubahan ke database jika tidak ada error
            DB::commit();

            // LOGIN-KAN PENGGUNA SECARA OTOMATIS BIAR DIA BISA
            //LANGSUNG MASUK KE HALAMAN PROFIL
            Auth::login($user);

            return redirect('/profile')->with('success', 'Akun berhasil dibuat');

        } catch (\Exception $e) {
            // Batalkan semua query jika terjadi error
            DB::rollBack();
            
            // Kembalikan ke halaman sebelumnya dengan input dan pesan error
            return back()->withInput()->withErrors(['db_error' => 'GAGAL: ' . $e->getMessage()]);
        }
    }

}