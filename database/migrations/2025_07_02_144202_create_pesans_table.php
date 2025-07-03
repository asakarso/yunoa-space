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
        Schema::create('pesans', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_pengirim');
            $table->unsignedInteger('id_penerima');
            $table->text('pesan');
            $table->unsignedInteger('id_konsultasi');
            $table->timestamps();

            $table->foreign('id_pengirim')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_konsultasi')->references('id_konsul')->on('consultations')->onDelete('cascade');
            $table->foreign('id_penerima')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesans');
    }
};
