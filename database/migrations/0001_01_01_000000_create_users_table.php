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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user');  // primary key dengan nama id_user
            $table->string('nama_user');
            $table->string('email_user');
            $table->string('pass_user');
            $table->string('nomor_telepon', 20);
            $table->integer('total_konseling')->default(0);
            // Tidak ada timestamps dan rememberToken sesuai permintaan
        });

        // Schema::create('password_reset_tokens', function (Blueprint $table) {
        //     $table->string('email');
        //     $table->string('token');
        //     $table->timestamp('created_at')->nullable();
        // });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('sessions');
        // Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
