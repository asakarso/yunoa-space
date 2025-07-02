<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id_review'); // Primary key auto increment
            $table->unsignedInteger('id_user');      // FK ke users
            $table->unsignedInteger('id_dokter');    // FK ke users (dokter)
            $table->unsignedInteger('id_konsul'); // FK ke consultations (asumsi tipe bigint)

            $table->date('tanggal_review');
            $table->time('waktu_review');
            $table->tinyInteger('rating');            // rating, misal 1-5
            $table->text('deskripsi_review');

            // Foreign key constraints
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_dokter')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_konsul')->references('id_konsul')->on('consultations')->onDelete('cascade');

            $table->timestamps(); // optional: created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
