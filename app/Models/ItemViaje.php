<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemViaje extends Model
{
    public $table = "ItemViaje";
    public $timestamps = false;

    protected $fillable = [
        'DNI',
        'nombreItem',
        'precioItem',
        'idViaje',
    ];
}