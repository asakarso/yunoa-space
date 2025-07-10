<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        // Bersihkan tabel dan gambar lama jika perlu
        // File::cleanDirectory(storage_path('app/public/article_covers'));
        DB::table('articles')->truncate();

        DB::table('articles')->insert([
            [
                'judul_artikel' => '5 Alasan Memiliki Sahabat Baik untuk Kesehatan Mental',
                'kategori' => 'Stres',
                'tanggal_artikel' => now()->subDays(5),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Persahabatan adalah salah satu hubungan paling berharga... (konten panjang dipersingkat di sini)',
                'gambar_cover' => '5_teman_kesehatan_mental.png',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Mengenal Stres dan Cara Mengelolanya dengan Baik',
                'kategori' => 'Stres',
                'tanggal_artikel' => now()->subDays(1),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Stres adalah respons alami tubuh terhadap tekanan...',
                'gambar_cover' => 'mengenal_stress_mengelola.png',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Pentingnya Dukungan Sosial untuk Kesehatan Mental',
                'kategori' => 'Kecemasan',
                'tanggal_artikel' => now()->subDays(2),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Manusia adalah makhluk sosial. Dukungan dari keluarga, teman...',
                'gambar_cover' => 'social_support.png',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Panduan Mengatasi Kecemasan dengan Terapi Pernapasan',
                'kategori' => 'Kecemasan',
                'tanggal_artikel' => now()->subDays(3),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Teknik pernapasan dalam (diaphragmatic breathing)...',
                'gambar_cover' => 'pernapasan.png',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Manfaat Olahraga Aerobik dan Hal yang Perlu Diperhatikan',
                'kategori' => 'Kecemasan',
                'tanggal_artikel' => now()->subDays(4),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Senam aerobik adalah latihan yang menyenangkan...',
                'gambar_cover' => 'aerobic.png',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Makanan yang Dapat Mengurangi Risiko Kecemasan dan Stres',
                'kategori' => 'Diet dan Nutrisi',
                'tanggal_artikel' => now()->subDays(6),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Mengonsumsi makanan tertentu dapat membantu mengurangi risiko...',
                'gambar_cover' => 'cegah-serangga.png',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Nutrisi Mikro dalam Tomat Ceri untuk Jaga Mood dan Kesehatan Tubuh',
                'kategori' => 'Diet dan Nutrisi',
                'tanggal_artikel' => now()->subDays(7),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Tomat ceri kaya akan vitamin dan antioksidan...',
                'gambar_cover' => 'tomat-ceri.png',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Kebutuhan Cairan dan Nutrisi Saat Stres: Kenali Tanda Dehidrasi',
                'kategori' => 'Diet dan Nutrisi',
                'tanggal_artikel' => now()->subDays(8),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Haus adalah sinyal alami tubuh akibat kekurangan cairan...',
                'gambar_cover' => 'merasa-haus.png',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Penerapan Digital Detox Untuk Kesehatan Mental',
                'kategori' => 'Kecemasan',
                'tanggal_artikel' => now()->subDays(9),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Penerapan digital detox merupakan cara yang baik...',
                'gambar_cover' => 'digital-detox.png',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Stres di Tempat Kerja? Kenali Tanda-tanda Burnout dan Cara Mengatasinya',
                'kategori' => 'Stres',
                'tanggal_artikel' => now()->subDays(10),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Burnout adalah kondisi kelelahan fisik, emosional...',
                'gambar_cover' => 'burnout.png',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Mengenal Diet Mediterania, Rahasia Umur Panjang dan Pikiran Sehat',
                'kategori' => 'Diet dan Nutrisi',
                'tanggal_artikel' => now()->subDays(11),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Diet Mediterania adalah pola makan yang kaya akan buah-buahan...',
                'gambar_cover' => 'diet-mediteranian.png',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
