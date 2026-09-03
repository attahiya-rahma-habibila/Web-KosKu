<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kamar', function (Blueprint $table) {

            $table->foreignId('kos_id')
                ->after('id')
                ->constrained('kos')
                ->cascadeOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('kamar', function (Blueprint $table) {

            $table->dropForeign(['kos_id']);

            $table->dropColumn('kos_id');

        });
    }
};