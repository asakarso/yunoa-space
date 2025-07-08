<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id_review'); // primary key
            $table->string('judul_artikel');
            $table->date('tanggal_artikel');
            $table->time('waktu_artikel');
            $table->unsignedInteger('operator_id'); // FK ke users.id_user
            $table->text('konten_artikel');
            $table->string('gambar_cover')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('operator_id')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
