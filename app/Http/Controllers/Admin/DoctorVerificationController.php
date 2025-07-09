<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorVerificationController extends Controller
{
    public function index()
    {
        $pendingDoctors = User::whereHas('roles', fn($q) => $q->where('nama_role', 'dokter'))
                              ->whereHas('doctor', fn($q) => $q->whereNull('verified_at'))
                              ->with('doctor')
                              ->latest()
                              ->paginate(10);

        return view('admin.verification.index', compact('pendingDoctors'));
    }

    public function show(User $doctor)
    {
        $doctor->load('doctor', 'profile');
        if (!$doctor->doctor) abort(404);
        
        return view('admin.verification.show', compact('doctor'));
    }

    public function verify(User $doctor)
    {
        if ($doctor->doctor) {
            $doctor->doctor->update(['verified_at' => now()]);
            return redirect()->route('admin.doctors.verification')->with('success', $doctor->nama_user . ' has been verified.');
        }
        return redirect()->route('admin.doctors.verification')->with('error', 'Doctor profile not found.');
    }

    public function reject(User $doctor)
    {
        if ($doctor->doctor) {
             $doctor->delete();
             return redirect()->route('admin.doctors.verification')->with('success', 'Registration for ' . $doctor->nama_user . ' has been rejected and deleted.');
        }
        return redirect()->route('admin.doctors.verification')->with('error', 'Doctor profile not found.');
    }
    
    // Method sendMessage() dihapus
}