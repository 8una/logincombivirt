<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suscriptores extends Model
{
    public $table = "Suscriptores";
    public $timestamps = false;

    protected $fillable = [
        'dni'
    ];
}