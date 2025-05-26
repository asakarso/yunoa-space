<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('reviews')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

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
            ]
        ]);
    }
}
