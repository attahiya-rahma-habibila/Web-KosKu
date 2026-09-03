<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('pemesanan_id')
                ->constrained('pemesanans')
                ->cascadeOnDelete();

            $table->decimal(
                'jumlah',
                15,
                2
            );

            $table->string(
                'metode_pembayaran'
            );

            $table->date(
                'tanggal_pembayaran'
            );

            $table->enum('status', [
                'menunggu',
                'berhasil',
                'ditolak'
            ])->default('menunggu');

            $table->text(
                'catatan'
            )->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists(
            'pembayarans'
        );
    }
};