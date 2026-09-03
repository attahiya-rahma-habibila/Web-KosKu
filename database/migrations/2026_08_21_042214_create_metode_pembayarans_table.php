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
        Schema::create('metode_pembayarans', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | JENIS PEMBAYARAN
            |--------------------------------------------------------------------------
            | Contoh:
            | Transfer
            | E-Wallet
            |--------------------------------------------------------------------------
            */
            $table->string('jenis');

            /*
            |--------------------------------------------------------------------------
            | NAMA METODE
            |--------------------------------------------------------------------------
            | Contoh:
            | BCA
            | BRI
            | Mandiri
            | DANA
            | OVO
            | GoPay
            |--------------------------------------------------------------------------
            */
            $table->string('nama_metode');

            /*
            |--------------------------------------------------------------------------
            | NOMOR REKENING / NOMOR E-WALLET
            |--------------------------------------------------------------------------
            */
            $table->string('nomor');

            /*
            |--------------------------------------------------------------------------
            | NAMA PEMILIK REKENING / E-WALLET
            |--------------------------------------------------------------------------
            */
            $table->string('atas_nama');

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            | true  = bisa digunakan user
            | false = tidak bisa digunakan
            |--------------------------------------------------------------------------
            */
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metode_pembayarans');
    }
};