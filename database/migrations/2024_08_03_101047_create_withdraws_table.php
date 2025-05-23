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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->references('id')
                ->on('users');
            $table->foreignId('withdrawTo')->references('id')->on('banks');
            $table->decimal('amount')->default(0);
            $table->decimal('fee')->default(0);
            $table->string('note');
            $table->string('reason_reject')->default("");
            $table->enum('status', ['success', 'pending', 'reject'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraws');
    }
};
