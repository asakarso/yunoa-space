<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'id_user' => 1,
                'nama_user' => 'Riyana',
                'email_user' => 'riyana@example.com',
                'pass_user' => Hash::make('password123'),
                'nomor_telepon' => '081234567890',
                'total_konseling' => 5,
            ],
            [
                'id_user' => 2,
                'nama_user' => 'Budi',
                'email_user' => 'budi@example.com',
                'pass_user' => Hash::make('secret456'),
                'nomor_telepon' => '089876543210',
                'total_konseling' => 2,
            ],
            [
                'id_user' => 3,
                'nama_user' => 'Asa',
                'email_user' => 'asa@example.com',
                'pass_user' => Hash::make('password'),
                'nomor_telepon' => '089876543210',
                'total_konseling' => 0,
            ],
            [
                'id_user' => 4,
                'nama_user' => 'Wati',
                'email_user' => 'wati@example.com',
                'pass_user' => Hash::make('secret456'),
                'nomor_telepon' => '089876543210',
                'total_konseling' => 6,
            ],
        ]);
    }
}
