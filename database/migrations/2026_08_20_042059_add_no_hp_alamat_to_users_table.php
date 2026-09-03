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
        Schema::table('users', function (Blueprint $table) {

            // Tambahkan no_hp hanya jika belum ada
            if (!Schema::hasColumn('users', 'no_hp')) {
                $table->string('no_hp')
                    ->nullable()
                    ->after('email');
            }

            // Tambahkan alamat hanya jika belum ada
            if (!Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')
                    ->nullable()
                    ->after('no_hp');
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Hapus no_hp jika ada
            if (Schema::hasColumn('users', 'no_hp')) {
                $table->dropColumn('no_hp');
            }

            // Hapus alamat jika ada
            if (Schema::hasColumn('users', 'alamat')) {
                $table->dropColumn('alamat');
            }

        });
    }
};