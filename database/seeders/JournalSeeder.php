<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JournalSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('journals')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('journals')->insert([
            [
                'judul_jurnal' => 'Mengenal Kesehatan Mental',
                'tanggal_jurnal' => now()->toDateString(),
                'waktu_jurnal' => now()->toTimeString(),
                'id_user' => 1,
                'konten_jurnal' => 'Artikel tentang pentingnya menjaga kesehatan mental di masa modern.',
                'gambar_cover' => 'mental_health_cover.jpg',
            ],
            // bisa tambah data lain di sini
        ]);
    }
}
