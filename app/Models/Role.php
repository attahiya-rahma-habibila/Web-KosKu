<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;


    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'roles';


    /*
    |--------------------------------------------------------------------------
    | PRIMARY KEY
    |--------------------------------------------------------------------------
    */

    protected $primaryKey = 'id_role';


    /*
    |--------------------------------------------------------------------------
    | FILLABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'nama_role',

    ];


    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP USERS
    |--------------------------------------------------------------------------
    */

    public function users()
    {
        return $this->hasMany(

            User::class,

            'id_role',

            'id_role'

        );
    }
}