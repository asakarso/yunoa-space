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
        // Menghapus gambar lama jika ada untuk pembersihan
        // File::cleanDirectory(storage_path('app/public/article_covers'));
        DB::table('articles')->truncate();

        DB::table('articles')->insert([
            [
                'judul_artikel' => '5 Alasan Memiliki Sahabat Baik untuk Kesehatan Mental',
                'kategori' => 'Stres',
                'tanggal_artikel' => now()->subDays(5),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => "Persahabatan adalah salah satu hubungan paling berharga.<br><br>Bersama sahabat, kamu bisa berbicara dengan percaya diri tentang hal-hal yang mungkin tak akan bisa didiskusikan dengan keluarga. Memiliki sahabat juga baik untuk kesehatan mental.<br><br>Kamu bisa menceritakan masalah pribadimu dengan teman dan begitu juga sebaliknya. Teman-teman dapat membuat kamu tetap tenang dan membantu memahami berbagai hal.<br><br>Oleh karena itu, berusahalah untuk mempertahankan persahabatan dan jangan berhenti untuk mencari teman baru.<strong>5 Alasan Memiliki Teman Baik untuk Kesehatan Mental</strong>Persahabatan yang sehat dapat bermanfaat bagi kesehatan mental. Sahabat dapat mendukung kamu ketika mereka bisa. Bahkan sekadar jadi pendengar keluh kesah pun bisa terasa membantu.<br><br>Berikut ini beberapa alasan mengapa memiliki sahabat baik untuk kesehatan mental:<strong>Lebih Sedikit Kesepian dan Isolasi Sosial</strong>Kesepian dan isolasi sosial dapat memengaruhi kesejahteraan mental dan fisik. Bahkan jika harus terisolasi secara sosial karena suatu hal, sahabat dapat membantu mencegah kesepian.<br><br>Namun, kualitas hubungan benar-benar penting. Persahabatan yang dangkal sering kali tidak memberikan banyak dukungan emosional.<br><br>Kamu mungkin memiliki teman bermain game, teman minum kopi, atau rekan olahraga, tetapi jika tidak memiliki siapa pun untuk curhat, kamu mungkin akan mengalami kesepian.<strong>Mengurangi Stres</strong>Setiap orang tentu pernah stres. Kamu mungkin mengalami gejala suasana hati, seperti kecemasan, depresi, atau lekas marah.<br><br>Namun, tetapi stres berkepanjangan tidak hanya memengaruhi kesehatan mental, tapi juga fisik.<br><br>Kabar baiknya, mempertahankan persahabatan yang kuat dapat membantu kamu mengatasi stres lebih efektif.<br><br>Jika kamu tahu bahwa kamu memiliki sahabat yang peduli dan siap membantu, stres sering kali tidak jadi berlarut-larut.<strong>Dukungan Emosional</strong>Dukungan emosional adalah manfaat penting dari suatu hubungan persahabatan. Seorang sahabat mampu mendukung kamu dengan cara:<br><ul><li>Mendengarkan keluh kesah dan masalah kamu.</li><li>Memvalidasi perasaanmu.</li><li>Melakukan hal-hal baik untukmu.</li><li>Membantu mengalihkan perhatian kamu ketika sedih atau kesal.</li></ul><strong>Rasa Memiliki</strong>Alasan lain mengapa sahabat baik untuk kesehatan mental adalah munculnya rasa saling memiliki. Setiap orang punya kebutuhan untuk “rasa memiliki”, setelah kebutuhan dasar (makanan dan tempat tinggal) dan kebutuhan keamanan.<br><br>Memiliki persahabatan yang erat membantu menumbuhkan rasa memiliki. Peduli terhadap orang lain membuat hidup lebih bermakna.<br><br>Ketika kamu peduli pada orang lain, kamu menawarkan kasih sayang dan dukungan emosional. Ini bisa membuat kamu menjadi orang yang lebih kuat dan lebih baik.<br><br>Pada saat yang sama, mengetahui bahwa kamu memiliki jaringan pendukung dapat membantu kamu merasa lebih aman dalam hidup.<br><br>Bahkan ketika sahabat menjadi jauh, kamu masih memiliki rasa memiliki jika selalu mempertahankan kontak dengan mereka.<strong>Dukungan Melalui Tantangan</strong>Hidup tidak selalu mudah, terkadang bahkan bisa menjadi sangat mengerikan. Pada waktu tertentu, tanpa peringatan, kamu mungkin menghadapi peristiwa traumatis atau sulit yang memengaruhi kesehatan mental.<br><br>Seperti putus dari kekasih, bercerai, kematian hewan peliharaan atau orang yang dicintai, pandemi, kehilangan pekerjaan, masalah keluarga, dan lain-lain. Semuanya bisa berdampak bagi kesehatan mental jangka panjang.<br><br>Namun, jika kamu memiliki persahabatan yang kuat, kamu mungkin akan merasa lebih mudah untuk menangani apa pun yang terjadi dalam hidup.<br><br>Karena kamu tidak merasa sendirian, dan kamu tahu bahwa ada orang yang akan selalu mendukung kamu.<br><br>Tak berhenti di situ, teman dapat saling memotivasi untuk menjalani gaya hidup sehat, seperti berolahraga, makan makanan bergizi, dan menghindari kebiasaan buruk.<br><br>Adanya teman yang memiliki tujuan yang sama dapat membuat seseorang lebih termotivasi dan konsisten dalam menjaga kesehatan.<br><br>Selain itu, teman juga dapat membantu mengidentifikasi dan mengatasi masalah kesehatan mental sejak dini.<br><br>Jika seseorang menunjukkan tanda-tanda depresi, kecemasan, atau masalah lainnya, teman dapat memberikan dukungan dan mendorong untuk mencari bantuan profesional.<br><br>Selain itu, kamu juga harus tahu ciri dari hubungan pertemanan yang tidak baik untukmu.<strong>Tips Menjaga Hubungan Baik dengan Teman</strong>Ini tips yang bisa kamu lakukan:<ul><li>Luangkan Waktu: Jadwalkan waktu untuk bertemu atau sekadar menghubungi teman secara rutin.</li><li>Dengarkan dengan Empati: Berikan perhatian penuh saat teman berbicara dan cobalah untuk memahami perspektifnya.</li><li>Berikan Dukungan: Tawarkan bantuan dan dukungan saat teman sedang mengalami masalah.</li><li>Jujur dan Terbuka: Komunikasikan perasaan dan pikiran secara jujur, namun tetap dengan sopan.</li><li>Hargai Perbedaan: Terima perbedaan pendapat dan pandangan dengan lapang dada.</li><li>Jaga Kepercayaan: Hindari bergosip atau membocorkan rahasia teman.</li></ul>Meskipun teman dapat memberikan dukungan yang berharga, ada kalanya seseorang membutuhkan bantuan profesional untuk mengatasi masalah kesehatan mental.<br><br>Segera cari bantuan profesional jika:<ul><li>Merasa sangat sedih atau putus asa.</li><li>Mengalami kesulitan tidur atau makan.</li><li>Kehilangan minat pada hal-hal yang disukai.</li><li>Memiliki pikiran untuk menyakiti diri sendiri.</li><li>Mengalami gejala kecemasan yang berlebihan.</li><li>Mengalami kesulitan dalam menjalankan aktivitas sehari-hari.</li></ul>Untungnya, Halodoc menyediakan berbagai layanan yang dapat membantu menjaga kesehatan mental, seperti:<ul><li>Konsultasi dengan psikolog atau psikiater: Konsultasi online dengan ahli untuk mendapatkan diagnosis dan penanganan yang tepat.</li><li>Tes kesehatan mental: Deteksi dini masalah kesehatan mental melalui tes online yang mudah dan akurat.</li><li>Obat-obatan: Tersedia berbagai jenis obat-obatan untuk mengatasi masalah kesehatan mental dengan resep dokter.</li></ul>Tunggu apa lagi? Yuk pakai Halodoc sekarang!<strong>Kesimpulan</strong>Memiliki teman baik adalah investasi berharga untuk kesehatan mental.<br><br>Dukungan sosial dari teman dapat meningkatkan kebahagiaan, mengurangi stres, meningkatkan kepercayaan diri, dan membantu mengatasi masa sulit.<br><br>Jalinlah hubungan yang sehat dengan teman dan jangan ragu untuk mencari bantuan profesional jika dibutuhkan. <br><br> <b>Referensi:</b> <br> <i>Mayo Clinic. Diakses pada 2025. Friendships: Enrich Your Life and Improve Your Health.</i><br><i>Mental Health Foundation UK. Diakses pada 2025. Friendship and Mental Health.</i>",
                'gambar_cover' => '5_teman_kesehatan_mental.png', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Mengenal Stres dan Cara Mengelolanya dengan Baik',
                'kategori' => 'Stres',
                'tanggal_artikel' => now()->subDays(1),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1, // Ganti dengan ID user operator/admin 
                'konten_artikel' => "Stres adalah respons alami tubuh terhadap tekanan dari lingkungan atau pikiran. Meskipun normal, stres yang berkepanjangan dapat berdampak buruk pada kesehatan fisik dan mental. Artikel ini membahas teknik relaksasi, mindfulness, dan manajemen waktu untuk membantu mengelola stres sehari-hari secara efektif, sehingga Anda dapat menjalani hidup yang lebih seimbang dan tenang.",
                'gambar_cover' => 'mengenal_stress_mengelola.png', // Pastikan nama file ini ada
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Pentingnya Dukungan Sosial untuk Kesehatan Mental',
                'kategori' => 'Kecemasan', 
                'tanggal_artikel' => now()->subDays(2),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Manusia adalah makhluk sosial. Dukungan dari keluarga, teman, dan komunitas sangat penting untuk menjaga kesehatan mental. Artikel ini menjelaskan bagaimana hubungan sosial yang kuat dapat menjadi tameng terhadap depresi dan kecemasan, serta memberikan tips praktis untuk membangun dan merawat jaringan dukungan Anda.',
                'gambar_cover' => 'social_support.png', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Panduan Mengatasi Kecemasan dengan Terapi Pernapasan',
                'kategori' => 'Kecemasan', 
                'tanggal_artikel' => now()->subDays(3),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Teknik pernapasan dalam (diaphragmatic breathing) adalah alat yang ampuh untuk menenangkan sistem saraf dan mengurangi gejala kecemasan secara cepat. Pelajari langkah-langkah sederhana untuk melakukannya dengan benar melalui panduan ini, kapan saja dan di mana saja Anda merasa cemas.',
                'gambar_cover' => 'pernapasan.png', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Manfaat Olahraga Aerobik dan Hal yang Perlu Diperhatikan',
                'kategori' => 'Kecemasan', 
                'tanggal_artikel' => now()->subDays(4),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Senam aerobik adalah latihan yang menyenangkan jantung dan tubuh secara menyeluruh. Selain membakar kalori, aerobik juga meningkatkan mood dan energi. Cari tahu manfaat lengkapnya dan hal-hal yang perlu Anda perhatikan sebelum memulai.',
                'gambar_cover' => 'aerobic.png', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
                        // 8 Artikel untuk "Artikel Terbaru"
            [
                'judul_artikel' => 'Makanan yang Dapat Mengurangi Risiko Kecemasan dan Stres',
                'kategori' => 'Diet dan Nutrisi', 
                'tanggal_artikel' => now()->subDays(6),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Mengonsumsi makanan tertentu dapat membantu mengurangi risiko kecemasan dan stres berlebihan...',
                'gambar_cover' => 'cegah-serangga.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Nutrisi Mikro dalam Tomat Ceri untuk Jaga Mood dan Kesehatan Tubuh"',
                'kategori' => 'Diet dan Nutrisi', 
                'tanggal_artikel' => now()->subDays(7),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Tomat ceri kaya akan vitamin dan antioksidan yang baik untuk tubuh. DAFTAR ISI.',
                'gambar_cover' => 'tomat-ceri.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Kebutuhan Cairan dan Nutrisi Saat Stres: Kenali Tanda Dehidrasi',
                'kategori' => 'Diet dan Nutrisi', 
                'tanggal_artikel' => now()->subDays(8),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Haus adalah sinyal alami tubuh akibat kekurangan cairan. Namun, jika berlebihan, bisa jadi tanda masalah kesehatan.',
                'gambar_cover' => 'merasa-haus.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Penerapan Digital Detox Untuk Kesehatan Mental',
                'kategori' => 'Kecemasan', 
                'tanggal_artikel' => now()->subDays(9),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Penerapan digital detox merupakan cara yang baik untuk mengatasi kecemasan yang berlebihan, rehat dari media sosial penting untuk menjaga mental menjadi tetap sehat.',
                'gambar_cover' => 'digital-detox.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Stres di Tempat Kerja? Kenali Tanda-tanda Burnout dan Cara Mengatasinya',
                'kategori' => 'Stres', 
                'tanggal_artikel' => now()->subDays(10),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Burnout adalah kondisi kelelahan fisik, emosional, dan mental akibat stres berkepanjangan di tempat kerja. Kenali tanda-tandanya dan pelajari cara mengatasinya. Salah satu caranya adalah mengharapkan gajih yang lebih tinggi supaya rasa burnout menjadi hilang, serta jangan sampai bournout menjadi alasan untuk kita menjadi malas bekerja.',
                'gambar_cover' => 'burnout.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Mengenal Diet Mediterania, Rahasia Umur Panjang dan Pikiran Sehat',
                'kategori' => 'Diet dan Nutrisi', 
                'tanggal_artikel' => now()->subDays(11),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Diet Mediterania adalah pola makan yang kaya akan buah-buahan, sayuran, biji-bijian, dan lemak sehat. Diet ini telah terbukti dapat meningkatkan kesehatan jantung, mengurangi risiko penyakit kronis, dan bahkan meningkatkan kesehatan mental. Pelajari lebih lanjut tentang manfaatnya dan bagaimana cara menerapkannya dalam kehidupan sehari-hari.',
                'gambar_cover' => 'diet-mediteranian.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
                        [
                'judul_artikel' => 'Makanan yang Dapat Mengurangi Risiko Kecemasan dan Stres',
                'kategori' => 'Diet dan Nutrisi', 
                'tanggal_artikel' => now()->subDays(12),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Mengonsumsi makanan tertentu dapat membantu mengurangi risiko kecemasan dan stres berlebihan...',
                'gambar_cover' => 'cegah-serangga.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Nutrisi Mikro dalam Tomat Ceri untuk Jaga Mood dan Kesehatan Tubuh"',
                'kategori' => 'Diet dan Nutrisi', 
                'tanggal_artikel' => now()->subDays(13),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Tomat ceri kaya akan vitamin dan antioksidan yang baik untuk tubuh. DAFTAR ISI.',
                'gambar_cover' => 'tomat-ceri.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Kebutuhan Cairan dan Nutrisi Saat Stres: Kenali Tanda Dehidrasi',
                'kategori' => 'Diet dan Nutrisi', 
                'tanggal_artikel' => now()->subDays(14),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Haus adalah sinyal alami tubuh akibat kekurangan cairan. Namun, jika berlebihan, bisa jadi tanda masalah kesehatan.',
                'gambar_cover' => 'merasa-haus.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Penerapan Digital Detox Untuk Kesehatan Mental',
                'kategori' => 'Kecemasan', 
                'tanggal_artikel' => now()->subDays(15),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Penerapan digital detox merupakan cara yang baik untuk mengatasi kecemasan yang berlebihan, rehat dari media sosial penting untuk menjaga mental menjadi tetap sehat.',
                'gambar_cover' => 'digital-detox.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Stres di Tempat Kerja? Kenali Tanda-tanda Burnout dan Cara Mengatasinya',
                'kategori' => 'Stres', 
                'tanggal_artikel' => now()->subDays(16),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Burnout adalah kondisi kelelahan fisik, emosional, dan mental akibat stres berkepanjangan di tempat kerja. Kenali tanda-tandanya dan pelajari cara mengatasinya. Salah satu caranya adalah mengharapkan gajih yang lebih tinggi supaya rasa burnout menjadi hilang, serta jangan sampai bournout menjadi alasan untuk kita menjadi malas bekerja.',
                'gambar_cover' => 'burnout.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_artikel' => 'Mengenal Diet Mediterania, Rahasia Umur Panjang dan Pikiran Sehat',
                'kategori' => 'Diet dan Nutrisi', 
                'tanggal_artikel' => now()->subDays(17),
                'waktu_artikel' => now()->toTimeString(),
                'operator_id' => 1,
                'konten_artikel' => 'Diet Mediterania adalah pola makan yang kaya akan buah-buahan, sayuran, biji-bijian, dan lemak sehat. Diet ini telah terbukti dapat meningkatkan kesehatan jantung, mengurangi risiko penyakit kronis, dan bahkan meningkatkan kesehatan mental. Pelajari lebih lanjut tentang manfaatnya dan bagaimana cara menerapkannya dalam kehidupan sehari-hari.',
                'gambar_cover' => 'diet-mediteranian.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}