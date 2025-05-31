<?php

namespace App\Http\Controllers;

//@asa nanti bisa buka comment ini, terus apus data dummy dibawah

//use App\Models\Doctor;
//$doctor = Doctor::findOrFail($doctor_id);


use Illuminate\Http\Request;
use Illuminate\View\View;

class CounselingController extends Controller
{
    public function showPayment($doctor_id): View
    {
        // Data dummy 
        $doctor = (object)[
            'name' => 'Dr. Putu',
            'specialization' => 'Psikolog Cinta'
        ];

        return view('counseling.payment', compact('doctor'));
    }
}
