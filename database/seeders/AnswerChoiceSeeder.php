<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerChoiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('answer_choices')->truncate();

        DB::table('answer_choices')->insert([
            ['pilihan_jawaban' => 'tidak pernah'],
            ['pilihan_jawaban' => 'jarang'],
            ['pilihan_jawaban' => 'kadang-kadang'],
            ['pilihan_jawaban' => 'sering'],
        ]);
    }
}
