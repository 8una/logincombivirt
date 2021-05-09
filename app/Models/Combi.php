<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combi extends Model
{
    protected $fillable = ['cant asientos', 'patente', 'tipo'];
    public $timestamps = false;
}
