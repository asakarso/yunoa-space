<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_answers', function (Blueprint $table) {

            $table->unsignedBigInteger('id_assess'); // FK ke tabel assesments
            $table->unsignedInteger('id_question'); // FK ke assesment_questions
            $table->string('user_choice'); // pilihan user
            $table->integer('skor'); // skor jawaban user

            // index untuk kolom foreign key
            $table->index('id_assess');
            $table->index('id_question');

            // foreign key constraints
            $table->foreign('id_assess')->references('id_assess')->on('assessments')->onDelete('cascade');
            $table->foreign('id_question')->references('id_question')->on('assesment_questions')->onDelete('cascade');

            // composite primary key supaya kombinasi id_asses dan id_question unik
            // $table->primary(['id_assess', 'id_question']);
 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};
