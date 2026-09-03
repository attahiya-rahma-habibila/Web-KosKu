<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBerhenti extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_berhentis';


    protected $fillable = [

        'pemesanan_id',

        'tanggal_pengajuan',

        'tanggal_berhenti',

        'alasan',

        'catatan_user',

        'status',

        'catatan_admin',

    ];


    protected $casts = [

        'tanggal_pengajuan' =>
            'date',

        'tanggal_berhenti' =>
            'date',

    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI PEMESANAN
    |--------------------------------------------------------------------------
    */

    public function pemesanan()
    {
        return $this->belongsTo(

            Pemesanan::class,

            'pemesanan_id'

        );
    }
}