<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans';


    protected $fillable = [

        'user_id',

        'kamar_id',

        'tanggal_masuk',

        'tanggal_keluar',

        'total_harga',

        'status',

        'catatan',

    ];


    protected $casts = [

        'tanggal_masuk' =>
            'date',

        'tanggal_keluar' =>
            'date',

        'total_harga' =>
            'decimal:2',

    ];


    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | KAMAR
    |--------------------------------------------------------------------------
    */

    public function kamar()
    {
        return $this->belongsTo(
            Kamar::class,
            'kamar_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PENGAJUAN BERHENTI
    |--------------------------------------------------------------------------
    */

    public function pengajuanBerhenti()
    {
        return $this->hasMany(
            PengajuanBerhenti::class,
            'pemesanan_id'
        );
    }
}