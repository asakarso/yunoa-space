<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_user' => 'required|email',
            'pass_user' => 'required'
        ]);

        $user = User::where('email_user', $request->email_user)->first();

        if ($user && Hash::check($request->pass_user, $user->pass_user)) {
            Auth::login($user);

            // Ambil role pertama user
            $role = $user->roles->first();

            if (!$role) {
                Auth::logout();
                return back()->withErrors(['Role pengguna tidak ditemukan.']);
            }

            // Cek verifikasi kalau rolenya dokter
            if (strtolower($role->nama_role) === 'dokter' && !$user->verified) {
                Auth::logout();
                return back()->withErrors(['Akun Anda belum diverifikasi admin.']);
            }

            // Redirect berdasarkan role
            return match (strtolower($role->nama_role)) {
                'admin' => redirect('/admin/dashboard'),
                'dokter' => redirect('/dokter/dashboard'),
                'operator' => redirect('/operator/dashboard'),
                default => redirect('/user/dashboard'),
            };
        }

        return back()->withErrors(['Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}