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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->decimal('balance')->default(0)->nullable();
            $table->decimal('balanceFree')->default(1000)->nullable();
            $table->string('photoProfile')->default('default.jpg');
            $table->string('address')->nullable();
            $table->string('bitcoinAddress')->nullable();
            $table->string('bank')->nullable();
            $table->string('identityCard')->nullable();
            $table->string('closeUpPhoto')->nullable();
            $table->boolean('notificationLogin')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
