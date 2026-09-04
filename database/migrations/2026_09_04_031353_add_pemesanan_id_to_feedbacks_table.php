<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->foreignId('pemesanan_id')
                ->after('kamar_id')
                ->constrained('pemesanans')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->dropForeign(['pemesanan_id']);
            $table->dropColumn('pemesanan_id');
        });
    }
};