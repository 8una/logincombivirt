<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    public $timestamps = false;
    protected $fillable = ['fecha', 'hora', 'duracion',
    'precio', 'ruta', 'patente', 'DNI'];
}