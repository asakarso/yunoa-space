<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assesment_answers', function (Blueprint $table) {
            $table->unsignedInteger('id_question')->index();
            $table->unsignedInteger('id_choice')->index();
            $table->integer('skor');
        
            $table->foreign('id_question')->references('id_question')->on('assesment_questions')->onDelete('cascade');
            $table->foreign('id_choice')->references('id_choice')->on('answer_choices')->onDelete('cascade');
        
            // // Composite Primary Key
            // $table->primary(['id_question', 'id_choice']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assesment_answers');
    }
};
