<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->increments('id_jurnal'); // primary key
            $table->string('judul_jurnal');
            $table->date('tanggal_jurnal');
            $table->time('waktu_jurnal');
            $table->unsignedInteger('id_user'); // foreign key ke users.id_user
            $table->text('konten_jurnal');
            $table->string('gambar_cover')->nullable();
            
            // foreign key constraint
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');

            // $table->timestamps(); // optional, huntuk created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
