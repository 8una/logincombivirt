<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    public $table = "Chofers";
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'apellido',
        'dni', 
        'email',
        'password',
    ];
}
