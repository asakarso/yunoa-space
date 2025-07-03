<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pesan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class PesanSeeder extends Seeder
{
    public function run(): void
    {

        // Kosongkan tabel pesan
        Pesan::truncate();

        try {
            // Ambil user dengan role dokter
            $dokter = User::whereHas('roles', function ($query) {
                $query->where('nama_role', 'dokter');
            })->firstOrFail();

            // Ambil user dengan role pengguna
            $pengguna = User::whereHas('roles', function ($query) {
                $query->where('nama_role', 'pengguna');
            })->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $this->command->error('GAGAL: Tidak menemukan user dengan role dokter/pengguna.');
            $this->command->error('Pastikan RoleSeeder dan UserSeeder sudah dijalankan dengan benar.');
            return;
        }

        $waktu = Carbon::now()->subHours(2);

        $percakapan = [
            [
                'pengirim' => $pengguna->id_user,
                'penerima' => $dokter->id_user,
                'pesan' => 'Selamat sore, Dok. Saya Budi. Saya ingin berkonsultasi.'
            ],
            [
                'pengirim' => $dokter->id_user,
                'penerima' => $pengguna->id_user,
                'pesan' => 'Selamat sore juga, Budi. Tentu, silakan ceritakan apa yang ingin kamu konsultasikan.'
            ],
            [
                'pengirim' => $pengguna->id_user,
                'penerima' => $dokter->id_user,
                'pesan' => 'Saya belakangan ini sering merasa cemas dan susah tidur.'
            ],
            [
                'pengirim' => $dokter->id_user,
                'penerima' => $pengguna->id_user,
                'pesan' => 'Baik, terima kasih sudah berbagi. Mari kita telusuri bersama.'
            ],
        ];

        foreach ($percakapan as $item) {
            Pesan::create([
                'id_pengirim' => $item['pengirim'],
                'id_penerima' => $item['penerima'],
                'id_konsultasi' => 1,
                'pesan' => $item['pesan'],
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ]);
            $waktu->addMinutes(rand(1, 5));
        }
    }
}
