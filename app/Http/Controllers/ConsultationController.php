<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        $query = User::whereHas('roles', function($q) {
            $q->where('nama_role', 'dokter');
        });

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_user', 'like', '%' . $request->search . '%');
        }

        $doctors = $query->get();

        return view('consultation', compact('doctors'));
    }
}