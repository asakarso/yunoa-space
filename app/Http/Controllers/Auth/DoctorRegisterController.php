<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
// Hapus semua 'use Mail' dan Mailable

class DoctorRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register-doctor');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nama_user' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'nomor_telepon' => 'required|string|max:20',
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'specialization' => 'required|string|max:255',
            'str_sip_file' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'schedule' => 'required|string',
            'consultation_price' => 'required|numeric|min:0',
            'education' => 'required|string',
            'email_user' => 'required|string|email|max:255|unique:users,email_user',
            'pass_user' => 'required|string|min:8|confirmed',
        ]);

        DB::beginTransaction();
        try {
            // Handle file uploads
            $photoPath = $request->file('foto_profil')->store('doctors', 'public');
            $strSipPath = $request->file('str_sip_file')->store('str_files', 'public');

            // Create User
            $user = User::create([
                'nama_user' => $validatedData['nama_user'],
                'email_user' => $validatedData['email_user'],
                'pass_user' => Hash::make($validatedData['pass_user']),
                'nomor_telepon' => $validatedData['nomor_telepon'],
                'foto_profil' => $photoPath,
            ]);

            $doctorRole = Role::where('nama_role', 'dokter')->firstOrFail();
            $user->roles()->attach($doctorRole->id_role);

            $user->doctor()->create([
                'specialization' => $validatedData['specialization'],
                'education' => $validatedData['education'],
                'str_sip_file' => $strSipPath,
                'schedule' => $validatedData['schedule'],
                'consultation_price' => $validatedData['consultation_price'],
                'verified_at' => null,
            ]);
            
            $user->profile()->create([
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
            ]);

            // Hapus semua logika pengiriman email
            
            DB::commit();

            return redirect()->route('register.doctor.status', ['email' => $user->email_user]);

        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($photoPath)) Storage::disk('public')->delete($photoPath);
            if (isset($strSipPath)) Storage::disk('public')->delete($strSipPath);
            
            return back()->withInput()->withErrors(['db_error' => 'Registration failed. Please try again. ' . $e->getMessage()]);
        }
    }
}