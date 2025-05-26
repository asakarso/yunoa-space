<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAnswerSeeder extends Seeder
{
    use WithoutModelEvents;  // ini supaya event model tidak dijalankan saat seeding

    public function run(): void
    {
        DB::table('user_answers')->truncate();

        DB::table('user_answers')->insert([
            [
                'id_asses' => 1,
                'id_question' => 1,
                'user_choice' => 'Sering',
                'skor' => 9,
    
            ],
            [
                'id_asses' => 1,
                'id_question' => 2,
                'user_choice' => 'Kadang-kadang',
                'skor' => 5,
            ],
        ]);
    }
}
