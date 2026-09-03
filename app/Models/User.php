<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'users';


    /*
    |--------------------------------------------------------------------------
    | FILLABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'name',

        'email',

        'password',

        'id_role',

        'no_hp',

        'alamat',

    ];


    /*
    |--------------------------------------------------------------------------
    | HIDDEN
    |--------------------------------------------------------------------------
    */

    protected $hidden = [

        'password',

        'remember_token',

    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',

        ];
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP ROLE
    |--------------------------------------------------------------------------
    */

    public function role()
    {
        return $this->belongsTo(

            Role::class,

            'id_role',

            'id_role'

        );
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP PEMESANAN
    |--------------------------------------------------------------------------
    */

    public function pemesanans()
    {
        return $this->hasMany(

            Pemesanan::class,

            'user_id'

        );
    }
}