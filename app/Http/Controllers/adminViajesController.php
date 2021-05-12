<?php

namespace App\Http\Controllers;


use App\Models\Viaje;
use App\Combi;
use App\Models\Chofer;
use App\Ruta;

use Illuminate\Http\Request;
class adminViajesController extends Controller
{
    public function showGestionDeViajes()
    {
        $hoy=date('Y-m-d');
        $msg="";
        $data=Viaje::where('fecha','>', $hoy)->orderBy('fecha','ASC')->orderBy('hora','ASC')->get();
        return view('vistasDeAdmin/gestionDeViajes')->with(['data' =>$data])->with('msg',$msg);
    } 


    public function create()
    {
        $data=Ruta::all();
        $msg=" ";
        return view('/vistasDeAdmin/crearViaje')->with(['data' =>$data])->with('msg',$msg); 
    }

    public function selectcombiYChofer()
    {

        $ruta = request('combo');
        $fecha = request('fecha');
        $precio = request('precio');
        $hora = request('hora');
        $duracion= request('duracion');
        
        $choferesDeLaFechaLibres=Viaje::where("fecha" ,'=', $fecha)->where("hora",'<>',$hora)->select('DNI')->distinct()->get();

        $choferes= Chofer::select('DNI')->distinct()->get()->union($choferesDeLaFechaLibres);
        $choferesCount= Chofer::select('DNI')->distinct()->get()->union($choferesDeLaFechaLibres)->count();

        $combisLibres= (Viaje::where("fecha", '=', $fecha)->where("hora",'<>',$hora)->select('patente')->distinct()->get());
        $combisPatente= Combi::select('patente')->distinct()->get()->union($combisLibres);
        $combisCount= Combi::select('patente')->distinct()->get()->union($combisLibres)->count();
        
        
        return view("vistasDeAdmin/selectCombiYChofer")->with(['data' =>$combisPatente])->with(['choferes' =>$choferes])->with("ruta",$ruta)->with("precio",$precio)->with("fecha",$fecha)->with("hora",$hora)->with("duracion",$duracion)->with('cantCombis',$combisCount)->with('cantChoferes',$choferesCount); 
    }

    public function crearviaje()
    {
        $patente = request('patente');
        $dni = request('dni');
        $ruta = request('ruta');
        $fecha = request('fecha');
        $precio = request('precio');
        $hora = request('hora'); 
        $duracion=request('duracion');

        $capacidadCombi= Combi::where('patente', $patente)->select('cant asientos')->get();
        $capacidadCombi=substr($capacidadCombi,18,2);
        Viaje::create([
            'ruta' => $ruta,
            'patente'=> $patente,
            'DNI'=> $dni,
            'fecha'=> $fecha,
            'hora'=> $hora,
            'duracion'=> $duracion,
            'cant disponibles'=> $capacidadCombi,
            'precio'=>$precio
        ]);

        $msg="El viaje se cargo con exito!!";
        $data= Ruta::all();
        return view('/vistasDeAdmin/crearViaje')->with(['data' =>$data])->with('msg',$msg);
    } 

    public function borrarviaje($viaje, $patente)
    {
        $cantLibres=Viaje::where('id',$viaje)->select('cant disponibles')->get();
        $msg="El viaje se borro satisfactoriamente";
        if(strlen($cantLibres)==24){
            $cantLibres= substr($cantLibres,21,1);
        }
        else{
            $cantLibres= substr($cantLibres,21,2);
        }

        $tipo = Combi::where('patente',$patente)->get('tipo');
        if (strlen($tipo)==25){
            $tipo = substr($tipo,10,12 );
        }
        else {
            $tipo = substr($tipo, 10,6);
        }

        $cantLibres= intval($cantLibres);

        if(($tipo == 'comoda')and($cantLibres == 20)){
            Viaje::where('id',$viaje)->delete();
        }
        elseif(($tipo== 'super-comoda')and($cantLibres==22)){
            Viaje::where('id',$viaje)->delete();
        }
        else{
            if($tipo == 'comoda'){
                $cantLibres = 20-$cantLibres ;
            }
            else{
                $cantLibres = 22-$cantLibres ;
            }
            $msg="El viaje no puede borrarse este tiene: $cantLibres pasajeros" ;
        }
        $hoy=date('Y-m-d');
        $data=Viaje::where('fecha','>', $hoy)->orderBy('fecha','ASC')->orderBy('hora','ASC')->get();
        return view('vistasDeAdmin/gestionDeViajes')->with(['data' =>$data])->with('msg',$msg);
    }

    public function showActForm($viaje)
    {
        $data=Viaje::where('id',$viaje)->get();
        return view('vistasDeAdmin/actualizarViaje')->with(['data'=>$data])->with('id',$viaje);
    }

    public function selectCombiYChoferActualizar($idviaje){
        $ruta = request('ruta');
        $fecha = request('fecha');
        $precio = request('precio');
        $hora = request('hora');
        $duracion= request('duracion');
        
        $choferesDeLaFechaLibres=Viaje::where("fecha" ,'=', $fecha)->where("hora",'<>',$hora)->select('DNI')->distinct()->get();

        $choferes= Chofer::select('DNI')->distinct()->get()->union($choferesDeLaFechaLibres);
        $choferesCount= Chofer::select('DNI')->distinct()->get()->union($choferesDeLaFechaLibres)->count();

        $combisLibres= (Viaje::where("fecha", '=', $fecha)->where("hora",'<>',$hora)->select('patente')->distinct()->get());
        $combisPatente= Combi::select('patente')->distinct()->get()->union($combisLibres);
        $combisCount= Combi::select('patente')->distinct()->get()->union($combisLibres)->count();
        
        return view("vistasDeAdmin/selectCombiYChoferAct")->with(['data' =>$combisPatente])->with(['choferes' =>$choferes])->with("ruta",$ruta)->with("precio",$precio)->with("fecha",$fecha)->with("hora",$hora)->with("duracion",$duracion)->with('cantCombis',$combisCount)->with('cantChoferes',$choferesCount)->with('id',$idviaje);
    }

    public function actualizarViaje($viaje)
    {
        $msg = "El viaje se actualizo con exito";
        $ruta = request('ruta');
        $fecha = request('fecha');
        $precio = request('precio');
        $hora = request('hora');
        $duracion= request('duracion');
        $patente= request('patente');
        $capacidadCombi= Combi::where('patente', $patente)->select('cant asientos')->get();
        $capacidadCombi=substr($capacidadCombi,18,2);
        
        $dni= request('dni');
        

        Viaje::where('id',$viaje)->update([
            'ruta' => $ruta,
            'patente'=> $patente,
            'DNI'=> $dni,
            'fecha'=> $fecha,
            'hora'=> $hora,
            'duracion'=> $duracion,
            'cant disponibles'=> $capacidadCombi,
            'precio'=>$precio
        ]);
        $hoy=date('Y-m-d');
        $data=Viaje::where('fecha','>', $hoy)->orderBy('fecha','ASC')->orderBy('hora','ASC')->get();
        return view('vistasDeAdmin/gestionDeViajes')->with(['data' =>$data])->with('msg',$msg);
    }
}
