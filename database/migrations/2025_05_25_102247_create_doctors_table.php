<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id'); 
            $table->unsignedInteger('user_id')->unique(); 
            $table->string('specialization');
            $table->text('schedule')->nullable(); 
            $table->decimal('consultation_price', 10, 2)->nullable(); 
            
            $table->timestamps();

            // Mendefinisikan foreign key constraint
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};