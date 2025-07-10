<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Doctor;
use Carbon\Carbon;

class ConsultationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('consultations')->delete();
        DB::table('consultations')->insert([
            [
                'id_user' => 2,
                'id_dokter' => 4,
                'id_payment' => 1,

                'tanggal_konsultasi' => '2025-07-06',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '10:30:00',
                'status' => 'selesai',
                'laporan_hasil' => 'Pasien mengalami gejala ringan dan disarankan istirahat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
