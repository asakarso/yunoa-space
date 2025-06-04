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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_answers')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('user_answers')->insert([
            [
                'id_assess' => 1,
                'id_question' => 1,
                'user_choice' => 5,
    
            ],
            [
                'id_assess' => 1,
                'id_question' => 2,
                'user_choice' => 5,
            ],
            [
                'id_assess' => 1,
                'id_question' => 3,
                'user_choice' => 5,
            ],
            [
                'id_assess' => 1,
                'id_question' => 4,
                'user_choice' => 5,
            ],
            [
                'id_assess' => 1,
                'id_question' => 5,
                'user_choice' => 5,
            ],
            [
                'id_assess' => 1,
                'id_question' => 6,
                'user_choice' => 5,
            ],
            [
                'id_assess' => 1,
                'id_question' => 7,
                'user_choice' => 5,
            ],
            [
                'id_assess' => 1,
                'id_question' => 8,
                'user_choice' => 5,
            ],
            [
                'id_assess' => 1,
                'id_question' => 9,
                'user_choice' => 5,
            ],
            [
                'id_assess' => 1,
                'id_question' => 10,
                'user_choice' => 5,
            ],
        ]);
    }
}
