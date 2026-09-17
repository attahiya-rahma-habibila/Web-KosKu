<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';


    protected $fillable = [

        'pemesanan_id',
        'metode_pembayaran_id',
        'jumlah',
        'tanggal_pembayaran',
        'status',
        'catatan',
        'bukti_pembayaran',
        'order_id',
        'snap_token',


    ];


    protected $casts = [

        'jumlah' => 'decimal:2',

        'tanggal_pembayaran' => 'date',

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


    /*
    |--------------------------------------------------------------------------
    | RELASI METODE PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function metodePembayaran()
    {
        return $this->belongsTo(
            MetodePembayaran::class,
            'metode_pembayaran_id'
        );
    }
}