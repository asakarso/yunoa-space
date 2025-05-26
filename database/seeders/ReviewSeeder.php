<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        DB::table('reviews')->truncate();

        DB::table('reviews')->insert([
            [
                'id_user' => 1,
                'id_dokter' => 2,
                'id_konsul' => 1,
                'tanggal_review' => now()->toDateString(),
                'waktu_review' => now()->toTimeString(),
                'rating' => 5,
                'deskripsi_review' => 'Dokternya sangat ramah dan membantu dalam konsultasi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'id_dokter' => 1,
                'id_konsul' => 2,
                'tanggal_review' => now()->toDateString(),
                'waktu_review' => now()->toTimeString(),
                'rating' => 4,
                'deskripsi_review' => 'Pelayanan bagus, tapi perlu perbaikan waktu tunggu.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
