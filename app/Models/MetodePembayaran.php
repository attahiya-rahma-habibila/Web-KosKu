<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $table = 'metode_pembayarans';


    protected $fillable = [

        'jenis',

        'nama_metode',

        'nomor',

        'atas_nama',

        'status',
        'is_midtrans'

    ];


    protected $casts = [

        'status' => 'boolean',

    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function pembayarans()
    {
        return $this->hasMany(
            Pembayaran::class,
            'metode_pembayaran_id'
        );
    }
}