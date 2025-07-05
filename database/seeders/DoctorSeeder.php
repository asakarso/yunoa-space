<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for doctors
        $doctorsData = [
            [
                'nama_user' => 'Dr. Anisa Putri',
                'email_user' => 'anisa.putri@example.com',
                'pass_user' => Hash::make('password123'),
                'nomor_telepon' => '081234567890',
                'specialization' => 'Clinical Psychologist',
                'schedule' => 'Mon, Wed, Fri (09:00 - 15:00)',
                'consultation_price' => 250000,
                'foto_profil' => 'doctors/doctor1.jpg', // path in public/storage/doctors
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_user' => 'Dr. Budi Santoso',
                'email_user' => 'budi.santoso@example.com',
                'pass_user' => Hash::make('password123'),
                'nomor_telepon' => '081234567891',
                'specialization' => 'Marriage & Family Counselor',
                'schedule' => 'Tue, Thu (10:00 - 17:00)',
                'consultation_price' => 300000,
                'foto_profil' => 'doctors/doctor2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_user' => 'Dr. Citra Lestari',
                'email_user' => 'citra.lestari@example.com',
                'pass_user' => Hash::make('password123'),
                'nomor_telepon' => '081234567892',
                'specialization' => 'Child Development Specialist',
                'schedule' => 'Weekend (10:00 - 14:00)',
                'consultation_price' => 275000,
                'foto_profil' => 'doctors/doctor3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Get the id for the 'dokter' role
        $roleDokterId = DB::table('roles')->where('nama_role', 'dokter')->first()->id_role;

        foreach ($doctorsData as $doctor) {
            // Create the user
            $user = User::create($doctor);
            
            // Assign the 'dokter' role to the user
            DB::table('user_roles')->insert([
                'id_user' => $user->id_user,
                'id_role' => $roleDokterId,
            ]);
        }
    }
}