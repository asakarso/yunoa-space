<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_doctors' => Doctor::count(),
            'pending_doctors' => Doctor::whereNull('verified_at')->count(),
            'total_pengguna' => User::whereHas('roles', fn($q) => $q->where('nama_role', 'pengguna'))->count(), // Tambahkan baris ini
            'total_admins' => User::whereHas('roles', fn($q) => $q->where('nama_role', 'admin'))->count(),
            'total_operators' => User::whereHas('roles', fn($q) => $q->where('nama_role', 'operator'))->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}