<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // Admin
            'verified' => true,
        ]);

        // Dokter
        User::create([
            'name' => 'Dokter Satu',
            'email' => 'dokter@example.com',
            'password' => Hash::make('password'),
            'role_id' => 4, // Dokter
            'verified' => true, // Penting!
        ]);

        // Operator
        User::create([
            'name' => 'Operator Satu',
            'email' => 'operator@example.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // Operator
            'verified' => true,
        ]);

        // Pengguna
        User::create([
            'name' => 'Pengguna Biasa',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1, // Pengguna
            'verified' => true,
        ]);
    }
}
