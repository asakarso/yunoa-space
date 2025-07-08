<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_profiles', function (Blueprint $table) {
            $table->id();

           // Tentukan tipe data secara eksplisit agar cocok 
           // dengan tipe data di tabel users yang dibuat menggunakan increment 
           // yang menghasilkan integer
            $table->unsignedInteger('id_user'); // INTEGER, cocok dengan 'increments'

            // Kolom-kolom untuk informasi kesejahteraan pasien
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('aktivitas_utama')->nullable();
            $table->string('tujuan_menggunakan')->nullable(); //menggunakan aplikasi
            $table->string('jam_tidur')->nullable();
            $table->timestamps();

            // Buat foreign key secara manual setelah kolom didefinisikan
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_profiles');
    }
};

// untuk melakukan fresh: php artisan migrate:fresh