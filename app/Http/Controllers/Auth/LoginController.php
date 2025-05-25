<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Kalau role dokter dan belum diverifikasi, logout
            if ($user->role->nama_role === 'Dokter' && !$user->verified) {
                Auth::logout();
                return back()->withErrors(['Akun Anda belum diverifikasi admin.']);
            }

            // Redirect berdasarkan role
            return match ($user->role->nama_role) {
                'Admin' => redirect('/admin/dashboard'),
                'Dokter' => redirect('/dokter/dashboard'),
                'Operator' => redirect('/operator/dashboard'),
                default => redirect('/user/dashboard'),
            };
        }

        return back()->withErrors(['Email atau password salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
