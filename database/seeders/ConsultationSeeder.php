<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('consultations')->insert([
            [
                'id_user' => 1, // Riyana sebagai pasien
                'id_dokter' => 2, // Budi sebagai dokter
                'tanggal_konsultasi' => now()->toDateString(),
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '10:30:00',
                'status' => 'selesai',
                'laporan_hasil' => 'Pasien mengalami gejala ringan dan disarankan istirahat.'
            ],
        ]);
    }
}
