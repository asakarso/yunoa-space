<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorStatusController extends Controller
{
    /**
     * Show the doctor registration status page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $user = User::where('email_user', $request->email)->with('doctor')->first();

        // Jika tidak ada user atau bukan dokter, arahkan ke login
        if (!$user || !$user->roles->contains('nama_role', 'dokter')) {
            return redirect()->route('login')->with('error', 'No doctor registration found for this email.');
        }

        return view('auth.doctor-status', ['doctor' => $user]);
    }
}