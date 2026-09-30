<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kos;
use App\Models\Pemesanan;
use App\Models\Penghuni;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';

    protected $fillable = [
        'kos_id',
        'nomor_kamar',
        'tipe_kamar',
        'harga',
        'luas',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI KOS
    |--------------------------------------------------------------------------
    */

    public function kos()
    {
        return $this->belongsTo(
            Kos::class,
            'kos_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI PEMESANAN
    |--------------------------------------------------------------------------
    */

    public function pemesanans()
    {
        return $this->hasMany(
            Pemesanan::class,
            'kamar_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI PENGHUNI
    |--------------------------------------------------------------------------
    */

    public function penghuni()
    {
        return $this->hasMany(
            Penghuni::class,
            'kamar_id'
        );
    }
}