<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class DoctorSeeder extends Seeder
{

    public function run(): void
    {
        $roleDokter = Role::where('nama_role', 'dokter')->firstOrFail();

        $doctorsData = [
            [
                'user' => [
                    'nama_user' => 'dr. Anisa Putri',
                    'email_user' => 'anisa.putri@example.com',
                    'pass_user' => Hash::make('password123'),
                    'nomor_telepon' => '081234567890',
                    'foto_profil' => 'doctors/doctor1.jpg',
                ],
                'doctor_profile' => [
                    'specialization' => 'Clinical Psychologist',
                    'schedule' => 'Mon, Wed, Fri (09:00 - 15:00)',
                    'consultation_price' => 250000,
                ]
            ],
            [
                'user' => [
                    'nama_user' => 'dr. Budi Santoso',
                    'email_user' => 'budi.santoso@example.com',
                    'pass_user' => Hash::make('password123'),
                    'nomor_telepon' => '081234567891',
                    'foto_profil' => 'doctors/doctor2.jpg',
                ],
                'doctor_profile' => [
                    'specialization' => 'Clinical Psychologist',
                    'schedule' => 'Tue, Thu (10:00 - 17:00)',
                    'consultation_price' => 300000,
                ]
            ],
            [
                'user' => [
                    'nama_user' => 'dr. Citra Lestari',
                    'email_user' => 'citra.lestari@example.com',
                    'pass_user' => Hash::make('password123'),
                    'nomor_telepon' => '081234567892',
                    'foto_profil' => 'doctors/doctor3.jpg',
                ],
                'doctor_profile' => [
                    'specialization' => 'Clinical Psychologist',
                    'schedule' => 'Weekend (10:00 - 14:00)',
                    'consultation_price' => 275000,
                ]
            ],
            [
                'user' => [
                    'nama_user' => 'Wati Ningsih, S.Psi., M.Psi.',
                    'email_user' => 'wati@example.com',
                    'pass_user' => Hash::make('secret456'),
                    'nomor_telepon' => '089876543210',
                    'foto_profil' => 'foto_profil/4.jpg',
                    'total_konseling' => 6, 
                ],
                'doctor_profile' => [
                    'specialization' => 'Clinical Psychologist',
                    'schedule' => 'Mon, Wed, Fri (09:00 - 15:00)',
                    'consultation_price' => 250000,
                ]
            ],
            [
                'user' => [
                    'nama_user' => 'Antonio Putra, S.Psi., M.Psi.',
                    'email_user' => 'anton@example.com',
                    'pass_user' => Hash::make('secret456'),
                    'nomor_telepon' => '089876777210',
                    'foto_profil' => 'foto_profil/5.jpg',
                    'total_konseling' => 6,
                ],
                'doctor_profile' => [
                    'specialization' => 'Child Development Specialist',
                    'schedule' => 'Mon, Wed, Fri (09:00 - 15:00)',
                    'consultation_price' => 350000,
                ]
            ],
        ];


        foreach ($doctorsData as $data) {
            // Buat user terlebih dahulu
            $user = User::create($data['user']);
            
            // Buat profil dokter menggunakan relasi
            $user->doctor()->create($data['doctor_profile']);
            
            $user->roles()->attach($roleDokter->id_role);
        }
    }
}