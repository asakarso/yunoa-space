<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        // File::cleanDirectory(storage_path('app/public/article_covers'));
        DB::table('articles')->truncate();

        DB::table('articles')->insert([
            [
                'judul_artikel' => '5 Alasan Memiliki Sahabat Baik untuk Kesehatan Mental',
                'kategori' => 'Stres',
                'tanggal_artikel' => now()->subDays(5),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 3,
                'konten_artikel' => 'Persahabatan adalah salah satu hubungan paling berharga.<br><br>Bersama sahabat, kamu bisa berbicara dengan percaya diri... (konten lengkap dari versi main)',
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
                'operator_id' => 3,
                'konten_artikel' => 'Stres adalah respons alami tubuh terhadap tekanan dari lingkungan atau pikiran. Meskipun normal...',
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
                'operator_id' => 3,
                'konten_artikel' => 'Manusia adalah makhluk sosial. Dukungan dari keluarga, teman, dan komunitas sangat penting...',
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
                'operator_id' => 3,
                'konten_artikel' => 'Teknik pernapasan dalam (diaphragmatic breathing) adalah alat yang ampuh...',
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
                'operator_id' => 3,
                'konten_artikel' => 'Senam aerobik adalah latihan yang menyenangkan jantung dan tubuh secara menyeluruh...',
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
                'operator_id' => 3,
                'konten_artikel' => 'Mengonsumsi makanan tertentu dapat membantu mengurangi risiko kecemasan dan stres...',
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
                'operator_id' => 3,
                'konten_artikel' => 'Tomat ceri kaya akan vitamin dan antioksidan yang baik untuk tubuh...',
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
                'operator_id' => 3,
                'konten_artikel' => 'Haus adalah sinyal alami tubuh akibat kekurangan cairan. Namun, jika berlebihan...',
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
                'operator_id' => 3,
                'konten_artikel' => 'Digital detox merupakan cara yang baik untuk mengatasi kecemasan dan menjaga keseimbangan...',
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
                'operator_id' => 3,
                'konten_artikel' => 'Burnout adalah kondisi kelelahan fisik, emosional, dan mental akibat stres kerja...',
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
                'operator_id' => 3,
                'konten_artikel' => 'Diet Mediterania adalah pola makan yang kaya akan buah-buahan, sayuran, dan lemak sehat...',
                'gambar_cover' => 'diet-mediteranian.png',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
