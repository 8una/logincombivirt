<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combi extends Model
{
    protected $fillable = ['DNI', 'fechaInicio', 'fechaFin'];
    public $timestamps = false;
}
