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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('package_id')->references('id')->on('packages');
            $table->string('proof')->nullable();
            $table->string('paymentTo')->nullable();
            $table->decimal('amount');
            $table->enum('proccess', ['success', 'pending', 'reject'])->default('pending');
            $table->string('note')->nullable();
            $table->boolean('isPaid')->default(0);
            $table->timestamp('expiresAt')->nullable();
            $table->enum('status', ['active', 'noactive'])->default('noactive');
            $table->decimal('profit')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
