<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        // Start with the query to find users with the 'dokter' role
        $query = User::whereHas('roles', function($q) {
            // Correctly query the 'roles' table by 'nama_role'
            $q->where('nama_role', 'dokter');
        });

        // Check if there is a search query
        if ($request->has('search') && $request->search != '') {
            // Add a where clause to filter by the doctor's name
            $query->where('nama_user', 'like', '%' . $request->search . '%');
        }

        // Execute the query and get the results
        $doctors = $query->get();

        // Pass the doctors to the view
        return view('consultation', compact('doctors'));
    }
}