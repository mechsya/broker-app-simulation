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
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('code');
            $table->enum('type', ['buy', 'sell']);
            $table->enum('status', ['win', 'lose', 'pending'])->default('pending');
            $table->string('package');
            $table->string('market');
            $table->decimal('amount');
            $table->decimal('profit')->default(0);
            $table->string('open');
            $table->timestamp('expiresAt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
