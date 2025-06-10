<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email_user' => 'required|string|email|unique:users,email_user',
            'pass_user' => 'required|string|min:6|confirmed',
            'nomor_telepon' => 'required|string|max:20',
        ]);

        // Cek ID role 'pengguna'
        $rolePenggunaId = DB::table('roles')->where('nama_role', 'pengguna')->value('id_role');

        if (!$rolePenggunaId) {
            return back()->withErrors([
                'role_error' => 'Role pengguna belum tersedia di tabel roles.'
            ]);
        }

        // Simpan user baru
        $user = User::create([
            'nama_user' => $request->nama_user,
            'email_user' => $request->email_user,
            'pass_user' => Hash::make($request->pass_user),
            'nomor_telepon' => $request->nomor_telepon,
            'total_konseling' => 0,
        ]);

        DB::table('user_roles')->insert([
            'id_user' => $user->id_user,
            'id_role' => $rolePenggunaId,
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}