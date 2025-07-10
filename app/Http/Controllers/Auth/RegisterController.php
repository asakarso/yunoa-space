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
        // Validasi input
        $validatedData = $request->validate([
            'nama_user' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Male,Female',
            'nomor_telepon' => 'required|string|max:20',
            'email_user' => 'required|string|email|unique:users,email_user',
            'pass_user' => 'required|string|min:6|confirmed',
            'aktivitas_utama' => 'nullable|string|max:255',
            'tujuan_menggunakan' => 'nullable|string|max:255',
            'jam_tidur' => 'nullable|date_format:H:i',
        ]);

        try {
            DB::beginTransaction();
            
            $rolePenggunaId = DB::table('roles')->where('nama_role', 'pengguna')->value('id_role');
            if (!$rolePenggunaId) {
                throw new \Exception('Role "pengguna" not found in the database.');
            }

            $user = User::create([
                'nama_user' => $validatedData['nama_user'],
                'email_user' => $validatedData['email_user'],
                'foto_profil' => 'defaults/default-profile.jpg', // Default profile picture
                'pass_user' => Hash::make($validatedData['pass_user']),
                'nomor_telepon' => $validatedData['nomor_telepon'],
                'total_konseling' => 0,
            ]);

            $user->profile()->create([
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'aktivitas_utama' => $request->aktivitas_utama,
                'tujuan_menggunakan' => $request->tujuan_menggunakan,
                'jam_tidur' => $request->jam_tidur,
            ]);

            DB::table('user_roles')->insert([
                'id_user' => $user->id_user,
                'id_role' => $rolePenggunaId,
            ]);
            
            DB::commit();

            Auth::login($user);

            return redirect('/homepage')->with('success', 'Account created successfully! Welcome to Yunoa Space.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withInput()->withErrors(['db_error' => 'Registration failed: ' . $e->getMessage()]);
        }
    }
}