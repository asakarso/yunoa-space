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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('assesment_questions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('assesment_questions')->insert([
            ['pertanyaan' => 'Over the past month, how often did you feel exhausted without a clear reason?'],
            ['pertanyaan' => 'Over the past month, how often did you feel nervous or anxious?'],
            ['pertanyaan' => 'Over the past month, how often did you feel so anxious that nothing could calm you down?'],
            ['pertanyaan' => 'Over the past month, how often did you feel hopeless or discouraged?'],
            ['pertanyaan' => 'Over the past month, how often did you feel restless or had trouble staying still?'],
            ['pertanyaan' => 'Over the past month, how often did you feel so restless that you couldn’t sit still?'],
            ['pertanyaan' => 'Over the past month, how often did you feel depressed or down?'],
            ['pertanyaan' => 'Over the past month, how often did you feel like everything was a struggle?'],
            ['pertanyaan' => 'Over the past month, how often did you feel so sad that nothing could cheer you up?'],
            ['pertanyaan' => 'Over the past month, how often did you feel worthless or without value?']
        ]);
    }
}
