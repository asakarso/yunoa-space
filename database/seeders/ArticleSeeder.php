<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('articles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('articles')->insert([
            [
                'judul_artikel' => 'Mengenal Stres dan Cara Mengelolanya dengan Baik',
                'tanggal_artikel' => now()->toDateString(),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 3,
                'konten_artikel' => 'Stres adalah respons alami tubuh terhadap tekanan. Artikel ini membahas teknik relaksasi dan mindfulness untuk membantu mengelola stres sehari-hari.',
                'gambar_cover' => 'stres-management.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Pentingnya Dukungan Sosial untuk Kesehatan Mental',
                'tanggal_artikel' => now()->toDateString(),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 3,
                'konten_artikel' => 'Dukungan dari keluarga dan teman sangat penting untuk menjaga kesehatan mental. Artikel ini menjelaskan bagaimana membangun jaringan dukungan yang kuat.',
                'gambar_cover' => 'support-network.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Panduan Mengatasi Kecemasan dengan Terapi Pernapasan',
                'tanggal_artikel' => now()->toDateString(),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 3,
                'konten_artikel' => 'Teknik pernapasan dalam dapat membantu menenangkan pikiran dan mengurangi kecemasan. Pelajari cara melakukannya dengan benar melalui panduan ini.',
                'gambar_cover' => 'breathing-technique.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
