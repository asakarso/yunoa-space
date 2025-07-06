<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Perintah ini akan dijalankan saat Anda menjalankan 'php artisan migrate'.
     *
     * @return void
     */
    public function up(): void
    {
        // Mengakses tabel 'payments' yang sudah ada untuk dimodifikasi
        Schema::table('payments', function (Blueprint $table) {
            // Menambahkan kolom baru bernama 'payment_proof'
            // dengan tipe data string (untuk menyimpan nama/path file).
            // ->nullable() berarti kolom ini boleh kosong.
            // ->after('payment_detail') menempatkan kolom ini setelah kolom 'payment_detail' agar rapi.
            $table->string('payment_proof')->nullable()->after('payment_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * Perintah ini akan dijalankan jika Anda perlu membatalkan migrasi (rollback).
     *
     * @return void
     */
    public function down(): void
    {
        // Mengakses tabel 'payments' untuk dimodifikasi
        Schema::table('payments', function (Blueprint $table) {
            // Menghapus kolom 'payment_proof' jika migrasi dibatalkan.
            $table->dropColumn('payment_proof');
        });
    }
};