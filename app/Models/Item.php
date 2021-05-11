<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $table = "Items";
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'stock',
        'precio',
    ];
}

