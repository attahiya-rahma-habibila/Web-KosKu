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
        Schema::create('kamar', function (Blueprint $table) {

            $table->id();

            $table->string('nomor_kamar');

            $table->string('tipe_kamar');

            $table->decimal('harga', 15, 2);

            $table->string('luas')->nullable();

            $table->enum('status', [
                'Tersedia',
                'Terisi'
            ])->default('Tersedia');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};