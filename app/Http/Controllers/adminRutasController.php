<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ruta;
use App\Ciudad;
use App\Models\Viaje;
use DB;

class adminRutasController extends Controller
{
    public function showindex(){
 
        $data=Ruta::all();
        $msg="";
        return view('ruta/rutahome')->with(['data' =>$data])->with("mensaje", $msg);
    }


    public function crearRuta()
    {
        $origen=Ciudad::select('nombre')->distinct()->get();
        $msg="Por favor seleccione el origen de la Ruta:";
        return view('ruta/origen')->with(['data' =>$origen])->with("mensaje", $msg);
    }

    public function elegirDestino()
    {
        $origen=request('combo');
        $destino=Ciudad::select('nombre')->where('nombre','<>', $origen)->distinct()->get();
        $msg="Por favor seleccione el destino de la Ruta:";
        return view('ruta/destino')->with(['data' =>$destino])->with("origen", $origen)->with("mensaje", $msg);
    }

    public function cargarNuevaRuta()
    {
        $destino= request('combo');
        $origen= request('origen');
        $msg= "Ruta creada con extio";
        $ruta=$origen.', '.$destino;
        $cont=Ruta::where('nombreRuta', $ruta)->get()->count();

        if($cont == 0){
            Ruta::create([
                'nombreRuta' => $ruta,
                'origen'=> $origen,
                'destino'=> $destino]);
        }
        else{
            $msg="No se puede crear la ruta, ya existe.";
        }
        $data=Ruta::all();
        return view('ruta/rutahome')->with(['data' =>$data])->with("mensaje", $msg);
    }

    public function borrarRuta($ruta)
    {
        $hoy = date("Y-m-d");
        $msg="La ruta se borro satisfactoriamente";
        $nombreRuta=Ruta::where('id', $ruta)->value('nombreRuta');
        
        $viajesdeRuta=Viaje::where('ruta', $nombreRuta)->where('fecha', '>', $hoy)->count();

        if ($viajesdeRuta > 0){
            $msg="La ruta esta anotada a: ".$viajesdeRuta. " viajes, la misma no se puede borrar";
        }

        else{
            Ruta::where('id',$ruta)->delete();
        }
        $data=Ruta::all();
        return view('ruta/rutahome')->with(['data' =>$data])->with("mensaje", $msg);
    }

    public function buscarRuta()
    {
        $msg="";
        $data=Ruta::where('nombreRuta', request('ruta'))->orderBy('nombreRuta')->get();
        return view('ruta/rutahome')->with(['data' =>$data])->with("mensaje", $msg);
    }
    public function buscarRutaPorOrigen()
    {
        $msg="";
        $data=Ruta::where('origen', request('origen'))->orderBy('origen')->get();
        return view('ruta/rutahome')->with(['data' =>$data])->with("mensaje", $msg);
    }
    public function buscarRutaPorDestino()
    {
        $msg="";
        $data=Ruta::where('destino', request('destino'))->orderBy('destino')->get();
        return view('ruta/rutahome')->with(['data' =>$data])->with("mensaje", $msg);
    }

    public function crearCiudad()
    {
        $msg="Ingrese el nombre de la nueva ciudad:";
        return view('ruta/crearCiudad')->with("mensaje", $msg);
    }

    public function cargarNuevaCiudad()
    {
        $msg="Ciudad cargada correctamente:";
        
        $cont=Ciudad::where('nombre', request('ciudad'))->get()->count();

        if($cont == 0){
            Ciudad::create([
                'nombre' => request('ciudad')
            ]);
        }
        else{
            $msg="No se puede cargar la ciudad, ya existe.";
        }
        $data=Ruta::all();
        return view('ruta/rutahome')->with(['data' =>$data])->with("mensaje", $msg);
    }

    public function quitarCiudad()
    {
        $data=Ciudad::all();
        $msg="Elija la ciudad que quiere quitar:";
        return view('ruta/quitarCiudad')->with(['data' =>$data])->with("mensaje", $msg);
    }

    public function borrarciudad()
    {
        $ciudad= request('combo');
        $hoy = date("Y-m-d");
        /* $cantViajes=DB::table('rutas')->join('viajes', 'viajes.ruta', 'rutas.nombreRuta')->where('fecha', '>', $hoy)->where('rutas.origen', '=', $ciudad)->orWhere('rutas.destino', '=', $ciudad)->get()->count(); */
        $msg="La ciudad se borro satisfactoriamente";

        /* if ($cantViajes > 0){
            $msg="La ciudad esta anotada a: ".$cantViajes. " viajes, la misma no se puede borrar";
        }

        else{ */
            Ciudad::where('nombre', request('combo'))->delete();
        /* } */
        $data=Ruta::all();
        return view('ruta/rutahome')->with(['data' =>$data])->with("mensaje", $msg);
    }

}
