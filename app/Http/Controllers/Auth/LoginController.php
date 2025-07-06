<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Menangani upaya login.
     */
    public function login(Request $request)
    {
        // 1. Validasi input dari form
        $credentials = $request->validate([
            'email_user' => 'required|email',
            'pass_user' => 'required'
        ]);

        // 2. Ganti nama key agar cocok dengan kolom database untuk Auth::attempt
        // 'pass_user' harus menjadi 'password' agar Hash::check bekerja di dalam attempt
        $credentialsForAuth = [
            'email_user' => $credentials['email_user'],
            'password' => $credentials['pass_user']
        ];
        
        // 3. Coba lakukan login menggunakan fitur bawaan Laravel yang aman
        if (Auth::attempt($credentialsForAuth, $request->boolean('remember'))) {
            // Jika berhasil, regenerate session untuk keamanan
            $request->session()->regenerate();
            
            // Panggil method authenticated untuk pengalihan berdasarkan peran
            return $this->authenticated($request, Auth::user());
        }

        // 4. Jika login gagal, kembali ke form login dengan pesan error
        return back()->withErrors([
            'email_user' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email_user');
    }
    
    /**
     * Menangani pengalihan setelah pengguna berhasil diautentikasi.
     * Ini akan memisahkan logika pengalihan dari proses login.
     */
    protected function authenticated(Request $request, $user)
    {
        // Ambil peran pertama user. Jika tidak ada, default ke string kosong.
        $role = strtolower($user->roles->first()->nama_role ?? '');

        // Redirect berdasarkan peran
        switch ($role) {
            case 'admin':
                return redirect()->intended(route('admin.dashboard'));
            case 'dokter':
                return redirect()->intended(route('dokter.dashboard'));
            case 'operator':
                return redirect()->intended(route('operator.dashboard'));
            case 'pengguna':
                return redirect()->intended(route('homepage'));
            default:
                // Jika user punya akun tapi tidak punya peran, logout paksa untuk mencegah loop
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login')->with('error', 'Akun Anda tidak memiliki peran yang valid. Hubungi administrator.');
        }
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); // Arahkan ke landing page setelah logout
    }
}