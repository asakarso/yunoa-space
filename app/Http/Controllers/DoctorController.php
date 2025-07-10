<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display the specified doctor's profile.
     *
     * @param  \App\Models\User  $doctor
     * @return \Illuminate\View\View
     */
    public function show(User $doctor)
    {
        // Eager load the doctor's specific profile information
        $doctor->load('doctor');

        // Ensure the user being viewed is actually a doctor
        if (!$doctor->doctor) {
            abort(404, 'Doctor profile not found.');
        }

        return view('dokter.show', compact('doctor'));
    }
}