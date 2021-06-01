<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marcados extends Model
{
    public $table = "Marcados";
    public $timestamps = false;

    protected $fillable = [
        'DNI',
        'fechaInicio',
        'fechaFin'
    ];
}

