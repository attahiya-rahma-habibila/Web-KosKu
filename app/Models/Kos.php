<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    protected $table = 'kos';

    protected $fillable = [
        'nama_kos',
        'pemilik',
        'no_hp',
        'alamat',
        'latitude',
        'longitude',
        'harga',
        'deskripsi',
        'foto',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI KAMAR
    |--------------------------------------------------------------------------
    */

    public function kamars()
    {
        return $this->hasMany(
            Kamar::class,
            'kos_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RELASI FOTO KOS
    |--------------------------------------------------------------------------
    */

    public function fotoKoss()
    {
        return $this->hasMany(
            FotoKos::class,
            'kos_id'
        )
        ->orderBy('id');
    }
}