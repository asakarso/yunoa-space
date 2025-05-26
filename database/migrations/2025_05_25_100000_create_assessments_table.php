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
        Schema::create('assessments', function (Blueprint $table) {
            $table->increments('id_assess'); // primary key auto increment
            $table->unsignedInteger('id_user'); // foreign key ke users.id_user

            $table->date('tanggal_assess');
            $table->time('waktu_assess');
            $table->time('jam_selesai');
            $table->text('laporan_hasil');

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
