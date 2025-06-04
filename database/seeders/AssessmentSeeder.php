<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('assessments')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('assessments')->insert([
            [
                'id_user' => 1,
                'tanggal_assess' => '2025-05-25',
                'waktu_assess' => '09:00:00',
                'jam_selesai' => '10:00:00',
                'skor_hasil' => 50,
            ],
        ]);
    }
}
