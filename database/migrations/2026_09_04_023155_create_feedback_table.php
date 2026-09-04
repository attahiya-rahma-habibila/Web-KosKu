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
        Schema::create('feedbacks', function (Blueprint $table) {

            $table->id();

            // User yang memberikan feedback
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Kamar yang diberi feedback
            $table->foreignId('kamar_id')
                ->constrained('kamar')
                ->cascadeOnDelete();

            // Rating 1 - 5
            $table->unsignedTinyInteger('rating');

            // Komentar / feedback user
            $table->text('komentar');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};