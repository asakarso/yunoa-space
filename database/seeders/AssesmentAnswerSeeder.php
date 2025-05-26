<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssesmentAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Optional: kosongkan dulu tabelnya
        DB::table('assesment_answers')->truncate();

        // Contoh data: skor berdasarkan kombinasi pertanyaan dan pilihan jawaban
        DB::table('assesment_answers')->insert([
            // Pertanyaan 1
            ['id_question' => 1, 'id_choice' => 1, 'skor' => 1],
            ['id_question' => 1, 'id_choice' => 2, 'skor' => 2],
            ['id_question' => 1, 'id_choice' => 3, 'skor' => 3],
            ['id_question' => 1, 'id_choice' => 4, 'skor' => 4],

            // Pertanyaan 2
            ['id_question' => 2, 'id_choice' => 1, 'skor' => 1],
            ['id_question' => 2, 'id_choice' => 2, 'skor' => 2],
            ['id_question' => 2, 'id_choice' => 3, 'skor' => 3],
            ['id_question' => 2, 'id_choice' => 4, 'skor' => 4],

            // Pertanyaan 3
            ['id_question' => 3, 'id_choice' => 1, 'skor' => 1],
            ['id_question' => 3, 'id_choice' => 2, 'skor' => 2],
            ['id_question' => 3, 'id_choice' => 3, 'skor' => 3],
            ['id_question' => 3, 'id_choice' => 4, 'skor' => 4],
        ]);
    }
}
