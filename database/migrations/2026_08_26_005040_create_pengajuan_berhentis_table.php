<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'pengajuan_berhentis',
            function (Blueprint $table) {

                $table->id();


                $table->foreignId(
                    'pemesanan_id'
                )
                ->constrained(
                    'pemesanans'
                )
                ->cascadeOnDelete();


                $table->date(
                    'tanggal_pengajuan'
                );


                $table->date(
                    'tanggal_berhenti'
                );


                $table->text(
                    'alasan'
                );


                $table->text(
                    'catatan_user'
                )
                ->nullable();


                $table->enum(
                    'status',
                    [
                        'menunggu',
                        'disetujui',
                        'ditolak',
                    ]
                )
                ->default(
                    'menunggu'
                );


                $table->text(
                    'catatan_admin'
                )
                ->nullable();


                $table->timestamps();

            }
        );
    }


    public function down(): void
    {
        Schema::dropIfExists(
            'pengajuan_berhentis'
        );
    }
};