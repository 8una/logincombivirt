<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viaje;
use App\Combi;
use App\Chofer;

class adminViajesController extends Controller
{
    public function showGestionDeViajes()
    {
        $data= Viaje::all();
        return view('vistasDeAdmin/gestionDeViajes', ['data' =>$data]);
    } 
}
