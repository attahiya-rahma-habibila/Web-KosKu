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
        /*
        |--------------------------------------------------------------------------
        | CEK KOLOM id_role
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('users', 'id_role')) {

            Schema::table('users', function (Blueprint $table) {

                $table->unsignedBigInteger('id_role')
                    ->nullable()
                    ->after('id');

            });
        }


        /*
        |--------------------------------------------------------------------------
        | FOREIGN KEY
        |--------------------------------------------------------------------------
        |
        | id_role ternyata sudah memiliki foreign key.
        | Jadi jangan dibuat lagi.
        |
        */
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | HAPUS FOREIGN KEY JIKA ADA
        |--------------------------------------------------------------------------
        */

        try {

            Schema::table('users', function (Blueprint $table) {

                $table->dropForeign('users_id_role_foreign');

            });

        } catch (\Throwable $e) {

            // Foreign key tidak ada, lanjutkan saja.

        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS id_role
        |--------------------------------------------------------------------------
        */

        if (Schema::hasColumn('users', 'id_role')) {

            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('id_role');

            });
        }
    }
};