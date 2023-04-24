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
<<<<<<< HEAD:laravel/database/migrations/2014_10_12_100000_create_password_resets_table.php
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
=======
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
>>>>>>> parent of e8b561e (finish change laravel):laravel/database/migrations/2014_10_12_100000_create_password_reset_tokens_table.php
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
