<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $roleDokter = Role::where('nama_role', 'dokter')->firstOrFail();

        $doctorsData = [
            [
                'user' => [
                    'nama_user' => 'dr. Anisa Putri, M.Psi.',
                    'email_user' => 'anisa.putri@example.com',
                    'pass_user' => Hash::make('password123'),
                    'nomor_telepon' => '081234567890',
                    'foto_profil' => 'doctors/doctor1.jpg',
                ],
                'doctor_profile' => [
                    'specialization' => 'Clinical Psychologist',
                    'education' => 'University of Indonesia, Master of Psychology, 2017',
                    'str_sip_file' => 'str_files/sample.pdf',
                    'schedule' => 'Mon, Wed, Fri (09:00 - 15:00)',
                    'consultation_price' => 250000,
                    'verified_at' => Carbon::now(), 
                ]
            ],
            [
                'user' => [
                    'nama_user' => 'dr. Budi Santoso, M.Psi.',
                    'email_user' => 'budi.santoso@example.com',
                    'pass_user' => Hash::make('password123'),
                    'nomor_telepon' => '081234567891',
                    'foto_profil' => 'doctors/doctor2.jpg',
                ],
                'doctor_profile' => [
                    'specialization' => 'Marriage and Family Therapist',
                    'education' => 'Gadjah Mada University, Master of Psychology, 2015',
                    'str_sip_file' => 'str_files/sample.pdf',
                    'schedule' => 'Tue, Thu (10:00 - 17:00)',
                    'consultation_price' => 300000,
                    'verified_at' => Carbon::now(), 
                ]
            ],
            [
                'user' => [
                    'nama_user' => 'dr. Citra Lestari, S.Psi.',
                    'email_user' => 'citra.lestari@example.com',
                    'pass_user' => Hash::make('password123'),
                    'nomor_telepon' => '081234567892',
                    'foto_profil' => 'doctors/doctor3.jpg',
                ],
                'doctor_profile' => [
                    'specialization' => 'Child Development Specialist',
                    'education' => 'Padjadjaran University, Bachelor of Psychology, 2019',
                    'str_sip_file' => 'str_files/sample.pdf',
                    'schedule' => 'Weekend (10:00 - 14:00)',
                    'consultation_price' => 275000,
                    'verified_at' => null, 
                ]
            ],
            [
                'user' => [
                    'nama_user' => 'dr. Dedi Wijaya, Sp.K.J.',
                    'email_user' => 'dedi.wijaya@example.com',
                    'pass_user' => Hash::make('password123'),
                    'nomor_telepon' => '081234567893',
                    'foto_profil' => 'doctors/doctor4.jpg',
                ],
                'doctor_profile' => [
                    'specialization' => 'Psychiatrist',
                    'education' => 'Airlangga University, Specialist in Psychiatry, 2016',
                    'str_sip_file' => 'str_files/sample.pdf',
                    'schedule' => 'Mon - Fri (18:00 - 21:00)',
                    'consultation_price' => 350000,
                    'verified_at' => Carbon::now(), 
                ]
            ],
            [
                'user' => [
                    'nama_user' => 'dr. Eka Fitriani, M.Psi.',
                    'email_user' => 'eka.fitriani@example.com',
                    'pass_user' => Hash::make('password123'),
                    'nomor_telepon' => '081234567894',
                    'foto_profil' => 'doctors/doctor5.jpg',
                ],
                'doctor_profile' => [
                    'specialization' => 'Educational Psychologist',
                    'education' => 'Universitas Pendidikan Indonesia, Master of Psychology, 2018',
                    'str_sip_file' => 'str_files/sample.pdf',
                    'schedule' => 'Tue, Thu, Sat (08:00 - 12:00)',
                    'consultation_price' => 260000,
                    'verified_at' => Carbon::now(), 
                ]
            ],
        ];

        foreach ($doctorsData as $data) {
            // menghindari duplikasi saat seeder dijalankan kembali
            $user = User::updateOrCreate(
                ['email_user' => $data['user']['email_user']],
                $data['user']
            );

            // Perbarui atau buat profil dokter yang terkait
            $user->doctor()->updateOrCreate(
                ['user_id' => $user->id_user],
                $data['doctor_profile']
            );

            // Lampirkan role dokter jika belum ada
            $user->roles()->syncWithoutDetaching([$roleDokter->id_role]);
        }
    }
}