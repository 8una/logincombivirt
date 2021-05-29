<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $fillable = ['nombre', 'calificacion', 'comentario', 'fecha'];
    public $timestamps = false;
}
