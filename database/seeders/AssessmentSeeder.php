<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentSeeder extends Seeder
{
    public function run()
    {
        DB::table('assessments')->truncate();

        DB::table('assessments')->insert([
            [
                'id_user' => 1,
                'tanggal_assess' => '2025-05-25',
                'waktu_assess' => '09:00:00',
                'jam_selesai' => '10:00:00',
                'laporan_hasil' => 'Hasil asesmen menunjukkan pasien dalam kondisi baik.',
            ],
            [
                'id_user' => 2,
                'tanggal_assess' => '2025-05-24',
                'waktu_assess' => '13:30:00',
                'jam_selesai' => '14:15:00',
                'laporan_hasil' => 'Perlu tindakan lanjutan untuk kasus ini.',
            ],
        ]);
    }
}
