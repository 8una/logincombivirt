<?php

namespace App\Http\Controllers;


use App\Models\Viaje;
use App\Combi;
use App\Models\Chofer;
use App\Ruta;
use DB;

use Illuminate\Http\Request;
class adminViajesController extends Controller
{
    public function showGestionDeViajes()
    {
        $hoy=date('Y-m-d');
        $msg="";
        $data=Viaje::where('fecha','>=', $hoy)->orderBy('fecha','ASC')->orderBy('hora','ASC')->get();
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
        
        $fechaInicio= date ('Y-m-d H:i:s', (strtotime( $fecha.$hora)));
        $fechaFin = strtotime ( '+'.$duracion.' hour' , strtotime ($fechaInicio) ) ; 
        $fechaFin = date ( 'Y-m-d H:i:s' , $fechaFin); 
        $combisPatente = DB::table('combis')->whereNotExists(function ($query) {
            $fechaInicio= date ('Y-m-d H:i:s', (strtotime( request('fecha').request('hora'))));
            $fechaFin = strtotime ( '+'.request('duracion').' hour' , strtotime ($fechaInicio)) ; 
            $fechaFin = date ( 'Y-m-d H:i:s' , $fechaFin);  
            $query->select(DB::raw(1))
                ->from('viajes')                                                    
                ->whereColumn('viajes.patente', 'combis.patente')->whereBetween('viajes.inicio',[$fechaInicio,$fechaFin])
                ->orWhereColumn('viajes.patente', 'combis.patente')->whereBetween('viajes.fin',[$fechaInicio,$fechaFin])
                ->orWhereColumn('viajes.patente', 'combis.patente')->where('viajes.inicio','<', $fechaInicio)->where('viajes.fin','>', $fechaInicio)
                ->orWhereColumn('viajes.patente', 'combis.patente')->where('viajes.inicio','>', $fechaInicio)->where('viajes.fin','<', $fechaInicio);
        })->distinct()->select('patente')->get();

        $combisCount=$combisPatente->count();
        

        $choferes=DB::table('chofers')->whereNotExists(function ($query) {
            $fechaInicio= date ('Y-m-d H:i:s', (strtotime( request('fecha').request('hora'))));
            $fechaFin = strtotime ( '+'.request('duracion').' hour' , strtotime ($fechaInicio)) ; 
            $fechaFin = date ( 'Y-m-d H:i:s' , $fechaFin);  
            $query->select(DB::raw(1))
                ->from('viajes')                                                    
                ->whereColumn('chofers.DNI', 'viajes.DNI')->whereBetween('viajes.inicio',[$fechaInicio,$fechaFin])
                ->orWhereColumn('chofers.DNI', 'viajes.DNI')->whereBetween('viajes.fin',[$fechaInicio,$fechaFin])
                ->orWhereColumn('chofers.DNI', 'viajes.DNI')->where('viajes.inicio','<', $fechaInicio)->where('viajes.fin','>', $fechaInicio)
                ->orWhereColumn('chofers.DNI', 'viajes.DNI')->where('viajes.inicio','>', $fechaInicio)->where('viajes.fin','<', $fechaInicio);
        })->distinct()->select('DNI')->get();

        $choferesCount=$choferes->count();
        
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

        $fechaInicio= date ('Y-m-d H:i:s', (strtotime( $fecha.$hora)));
        $fechaFin = strtotime ( '+'.$duracion.' hour' , strtotime ($fechaInicio) ) ; 
        $fechaFin = date ( 'Y-m-d H:i:s' , $fechaFin); 

        $capacidadCombi= Combi::where('patente', $patente)->value('cant asientos');
        $capacidadCombi=($capacidadCombi)/2;

        Viaje::create([
            'ruta' => $ruta,
            'patente'=> $patente,
            'DNI'=> $dni,
            'fecha'=> $fecha,
            'hora'=> $hora,
            'duracion'=> $duracion,
            'cant disponibles'=> $capacidadCombi,
            'precio'=>$precio,
            'inicio'=>$fechaInicio,
            'fin'=>$fechaFin
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

        if(($tipo == 'comoda')and($cantLibres == 10)){
            Viaje::where('id',$viaje)->delete();
        }
        elseif(($tipo== 'super-comoda')and($cantLibres==11)){
            Viaje::where('id',$viaje)->delete();
        }
        else{
            if($tipo == 'comoda'){
                $cantLibres = 10-$cantLibres ;
            }
            else{
                $cantLibres = 11-$cantLibres ;
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


        $patente=Viaje::where('id',$idviaje)->select('patente')->value('patente');
        $dniAct=Viaje::where('id',$idviaje)->select('DNI')->value('DNI');
        $capacidad=Combi::where('patente',$patente)->value('cant asientos');

        $asientosDisponibles=Viaje::where('id',$idviaje)->select('cant disponibles')->value('cant disponibles');

        $fechaInicio= date ('Y-m-d H:i:s', (strtotime( $fecha.$hora)));
        $fechaFin = strtotime ( '+'.$duracion.' hour' , strtotime ($fechaInicio) ) ; 
        $fechaFin = date ( 'Y-m-d H:i:s' , $fechaFin); 
        $combisPatente = DB::table('combis')->whereNotExists(function ($query) {
            $fechaInicio= date ('Y-m-d H:i:s', (strtotime( request('fecha').request('hora'))));
            $fechaFin = strtotime ( '+'.request('duracion').' hour' , strtotime ($fechaInicio)) ; 
            $fechaFin = date ( 'Y-m-d H:i:s' , $fechaFin);  
            $query->select(DB::raw(1))
                ->from('viajes')                                                    
                ->whereColumn('viajes.patente', 'combis.patente')->whereBetween('viajes.inicio',[$fechaInicio,$fechaFin])
                ->orWhereColumn('viajes.patente', 'combis.patente')->whereBetween('viajes.fin',[$fechaInicio,$fechaFin])
                ->orWhereColumn('viajes.patente', 'combis.patente')->where('viajes.inicio','<', $fechaInicio)->where('viajes.fin','>', $fechaInicio)
                ->orWhereColumn('viajes.patente', 'combis.patente')->where('viajes.inicio','>', $fechaInicio)->where('viajes.fin','<', $fechaInicio);
        })->distinct()->select('patente')->get();

        $combisCount=$combisPatente->count();
        
        $choferes=DB::table('chofers')->whereNotExists(function ($query) {
            $fechaInicio= date ('Y-m-d H:i:s', (strtotime( request('fecha').request('hora'))));
            $fechaFin = strtotime ( '+'.request('duracion').' hour' , strtotime ($fechaInicio)) ; 
            $fechaFin = date ( 'Y-m-d H:i:s' , $fechaFin);  
            $query->select(DB::raw(1))
                ->from('viajes')                                                    
                ->whereColumn('chofers.DNI', 'viajes.DNI')->whereBetween('viajes.inicio',[$fechaInicio,$fechaFin])
                ->orWhereColumn('chofers.DNI', 'viajes.DNI')->whereBetween('viajes.fin',[$fechaInicio,$fechaFin])
                ->orWhereColumn('chofers.DNI', 'viajes.DNI')->where('viajes.inicio','<', $fechaInicio)->where('viajes.fin','>', $fechaInicio)
                ->orWhereColumn('chofers.DNI', 'viajes.DNI')->where('viajes.inicio','>', $fechaInicio)->where('viajes.fin','<', $fechaInicio);
        })->distinct()->select('DNI')->get();

        $choferesCount=$choferes->count();
        return view("vistasDeAdmin/selectCombiYChoferAct")->with(['data' =>$combisPatente])->with(['choferes' =>$choferes])->with("ruta",$ruta)->with("precio",$precio)->with("fecha",$fecha)->with("hora",$hora)->with("duracion",$duracion)->with('cantCombis',$combisCount)->with('cantChoferes',$choferesCount)->with('id',$idviaje)->with('patenteAct',$patente)->with('dniAct',$dniAct); 
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

        
        $fechaInicio= date ('Y-m-d H:i:s', (strtotime( $fecha.$hora)));
        $fechaFin = strtotime ( '+'.$duracion.' hour' , strtotime ($fechaInicio) ) ; 
        $fechaFin = date ( 'Y-m-d H:i:s' , $fechaFin); 

        $capacidadCombi= Combi::where('patente', $patente)->select('cant asientos')->value('cant asientos');
        
        
        $dni= request('dni');
        

        Viaje::where('id',$viaje)->update([
            'ruta' => $ruta,
            'patente'=> $patente,
            'DNI'=> $dni,
            'fecha'=> $fecha,
            'hora'=> $hora,
            'duracion'=> $duracion,
            'cant disponibles'=> $capacidadCombi,
            'precio'=>$precio,
            'inicio'=>$fechaInicio,
            'fin'=>$fechaFin
        ]);

        $hoy=date('Y-m-d');
        $data=Viaje::where('fecha','>', $hoy)->orderBy('fecha','ASC')->orderBy('hora','ASC')->get();
        return view('vistasDeAdmin/gestionDeViajes')->with(['data' =>$data])->with('msg',$msg);
    }
}
