<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('kamar_id')
                ->constrained('kamar')
                ->cascadeOnDelete();

            $table->date('tanggal_masuk');

            $table->date('tanggal_keluar');

            $table->enum('status', [
                'menunggu',
                'dikonfirmasi',
                'selesai',
                'dibatalkan'
            ])->default('menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};