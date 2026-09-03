<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    use HasFactory;


    protected $table = 'penghuni';


    protected $fillable = [

        'nama',

        'email',

        'no_hp',

        'alamat',

        'kamar_id',

        'tanggal_masuk',

        'status',

    ];


    protected $casts = [

        'tanggal_masuk' =>
            'date',

    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI KAMAR
    |--------------------------------------------------------------------------
    */

    public function kamar()
    {
        return $this->belongsTo(
            Kamar::class,
            'kamar_id'
        );
    }
}