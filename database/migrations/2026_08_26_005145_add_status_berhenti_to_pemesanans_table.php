<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            ALTER TABLE pemesanans
            MODIFY status VARCHAR(50)
            NOT NULL
            DEFAULT 'menunggu'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE pemesanans
            MODIFY status ENUM(
                'menunggu',
                'dikonfirmasi',
                'ditolak'
            )
            NOT NULL
            DEFAULT 'menunggu'
        ");
    }
};