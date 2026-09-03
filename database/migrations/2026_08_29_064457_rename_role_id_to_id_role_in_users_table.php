<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | id_role SUDAH ADA
        |--------------------------------------------------------------------------
        |
        | Database saat ini sudah menggunakan:
        |
        | users.id_role
        |      ↓
        | roles.id_role
        |
        | Jadi tidak perlu rename role_id lagi.
        |
        */

        // Tidak ada perubahan yang perlu dilakukan.
    }


    /**
     * Balikkan migration.
     */
    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Tidak ada perubahan yang perlu dibalik
        |--------------------------------------------------------------------------
        |
        | Kolom id_role dan foreign key-nya sudah dibuat
        | oleh migration sebelumnya.
        |
        */

        // Tidak ada perubahan yang perlu dilakukan.
    }
};