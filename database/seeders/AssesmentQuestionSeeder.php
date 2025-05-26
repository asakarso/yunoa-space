<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssesmentQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assesment_questions')->truncate();

        DB::table('assesment_questions')->insert([
            ['pertanyaan' => 'Apakah Anda merasa stres akhir-akhir ini?'],
            ['pertanyaan' => 'Seberapa sering Anda mengalami kesulitan tidur?'],
            ['pertanyaan' => 'Apakah Anda merasa cemas dalam situasi sosial?'],
        ]);
    }
}
