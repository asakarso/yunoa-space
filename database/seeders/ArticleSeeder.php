<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        DB::table('articles')->truncate();

        DB::table('articles')->insert([
            [
                'judul_artikel' => '5 Alasan Memiliki Sahabat Baik untuk Kesehatan Mental',
                'kategori' => 'Stres',
                'tanggal_artikel' => now()->subDays(5),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 3, // bisa ubah ke 1 jika memang default temanmu
                'konten_artikel' => 'Stres adalah respons alami tubuh terhadap tekanan. Artikel ini membahas teknik relaksasi dan mindfulness untuk membantu mengelola stres sehari-hari.',
                'gambar_cover' => 'stres-management.jpg',
                'status' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Mengenal Stres dan Cara Mengelolanya dengan Baik',
                'kategori' => 'Stres',
                'tanggal_artikel' => now()->subDays(1),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Stres adalah respons alami tubuh terhadap tekanan dari lingkungan atau pikiran. Meskipun normal, stres yang berkepanjangan dapat berdampak buruk pada kesehatan fisik dan mental. Artikel ini membahas teknik relaksasi, mindfulness, dan manajemen waktu untuk membantu mengelola stres sehari-hari secara efektif, sehingga Anda dapat menjalani hidup yang lebih seimbang dan tenang.',
                'gambar_cover' => 'mengenal_stress_mengelola.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Pentingnya Dukungan Sosial untuk Kesehatan Mental',
                'kategori' => 'Kecemasan',
                'tanggal_artikel' => now()->subDays(2),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 3, // atau 1, sesuaikan dengan konsistensi
                'konten_artikel' => 'Dukungan dari keluarga dan teman sangat penting untuk menjaga kesehatan mental. Artikel ini menjelaskan bagaimana membangun jaringan dukungan yang kuat.',
                'gambar_cover' => 'support-network.jpg',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Panduan Mengatasi Kecemasan dengan Terapi Pernapasan',
                'kategori' => 'Kecemasan',
                'tanggal_artikel' => now()->subDays(3),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 3,
                'konten_artikel' => 'Teknik pernapasan dalam dapat membantu menenangkan pikiran dan mengurangi kecemasan. Pelajari cara melakukannya dengan benar melalui panduan ini.',
                'gambar_cover' => 'breathing-technique.jpg',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan artikel lainnya dari versi teman jika perlu
        ]);
    }
}
