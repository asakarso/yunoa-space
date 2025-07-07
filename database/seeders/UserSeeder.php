<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        // Ambil objek Role terlebih dahulu agar lebih dinamis
        $roleAdmin = Role::where('nama_role', 'admin')->first();
        $rolePengguna = Role::where('nama_role', 'pengguna')->first();
        $roleOperator = Role::where('nama_role', 'operator')->first();

        // Data untuk user non-dokter
        $usersData = [
            [
                'user_data' => [
                    'nama_user' => 'Riyana',
                    'email_user' => 'riyana@example.com',
                    'pass_user' => Hash::make('password123'),
                    'nomor_telepon' => '081234567890',
                    'total_konseling' => 0,
                    'foto_profil' => 'foto_profil/1.jpg',
                ],
                'role' => $roleAdmin
            ],
            [
                'user_data' => [
                    'nama_user' => 'Budi',
                    'email_user' => 'budi@example.com',
                    'pass_user' => Hash::make('secret456'),
                    'nomor_telepon' => '089876543210',
                    'total_konseling' => 2,
                    'foto_profil' => 'foto_profil/2.jpg',
                ],
                'role' => $rolePengguna
            ],
            [
                'user_data' => [
                    'nama_user' => 'Putri',
                    'email_user' => 'putri@example.com',
                    'pass_user' => Hash::make('password'),
                    'nomor_telepon' => '089876543210',
                    'total_konseling' => 0,
                    'foto_profil' => 'foto_profil/3.jpg',
                ],
                'role' => $roleOperator
            ],
        ];

        foreach ($usersData as $data) {
            // Buat user menggunakan Eloquent
            $user = User::create($data['user_data']);

            if ($data['role']) {
                $user->roles()->attach($data['role']->id_role);
            }
        }
    }
}