<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->increments('id_konsul');
            $table->unsignedInteger('id_user');     // FK ke users (pasien)
            $table->unsignedInteger('id_dokter');   // FK ke users juga, tapi dengan role 'dokter'
            $table->date('tanggal_konsultasi');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('status')->default('menunggu');
            $table->text('laporan_hasil')->nullable();

            // foreign keys ke tabel yang sama
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_dokter')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
