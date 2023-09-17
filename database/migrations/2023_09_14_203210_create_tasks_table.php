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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('credit_card_id')->constrained('credit_cards');
            $table->foreignId('merchant_id')->constrained('merchants');
            $table->unsignedBigInteger('previous_credit_card_id')->nullable();
            $table->enum('status', ['finished', 'failed'])->default(null)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('previous_credit_card_id')->references('id')->on('credit_cards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
