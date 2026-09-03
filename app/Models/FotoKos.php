<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoKos extends Model
{
    protected $table = 'foto_kos';

    protected $fillable = [
        'kos_id',
        'foto',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI KE KOS
    |--------------------------------------------------------------------------
    */

    public function kos()
    {
        return $this->belongsTo(
            Kos::class,
            'kos_id'
        );
    }
}