<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Doctor; 

class ConsultationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('consultations')->delete();

        $patient = User::where('email_user', 'budi@example.com')->first();

        $doctorUser = User::where('email_user', 'anisa.putri@example.com')->first();
        
        if ($patient && $doctorUser && $doctorUser->doctor) {
            
            DB::table('consultations')->insert([
                [
                    'id_user' => $patient->id_user, 
                    'id_dokter' => $doctorUser->doctor->id, 
                    
                    'tanggal_konsultasi' => '2025-07-06',
                    'jam_mulai' => '10:00:00',
                    'jam_selesai' => '10:30:00',
                    'status' => 'selesai',
                    'laporan_hasil' => 'Pasien mengalami gejala ringan dan disarankan istirahat.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

        } else {
            $this->command->info('Patient or Doctor not found, skipping ConsultationSeeder.');
        }
    }
}