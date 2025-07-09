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

        $credentials = [
            'email_user' => $request->email_user,
            'password' => $request->pass_user
        ];

        // We use Auth::validate to check credentials without logging in
        if (!Auth::validate(['email_user' => $request->email_user, 'password' => $request->pass_user])) {
             return back()->withErrors(['email_user' => 'The provided credentials do not match our records.']);
        }

        $user = Auth::getProvider()->retrieveByCredentials(['email_user' => $request->email_user]);

        // Check if the user is a doctor and if they are verified
        if ($user->roles->contains('nama_role', 'dokter')) {
            if (!$user->doctor || !$user->doctor->verified_at) {
                return back()->withErrors(['email_user' => 'Your account is pending verification by an administrator.']);
            }
        }
        
        Auth::login($user);
        $request->session()->regenerate();

        $role = $user->roles->first()->nama_role;

        return match (strtolower($role)) {
            'admin' => redirect()->intended(route('admin.dashboard')),
            'dokter' => redirect()->intended(route('dokter.dashboard')),
            'operator' => redirect()->intended(route('operator.dashboard')),
            default => redirect()->intended(route('homepage')),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}