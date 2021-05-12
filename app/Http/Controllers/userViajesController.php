<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Viaje;
use App\Usuarioviaje;
use App\User;
use Carbon\Carbon;

class userViajesController extends Controller
{
    public function showMisViajes($dni)
    {
        $hoy = date("Y-m-d");
        $msg="";
        $data = DB::table('viajes')->join('usuarioviajes', 'usuarioviajes.idViaje','=','viajes.id')->where('dniusuario',$dni)->where('fecha','>', $hoy)->get();
        return view('vistasDeUsuario/viajesDelUsuario')->with(['data'=>$data])->with('msg',$msg);
        
    }

    public function cancelarViaje($dni, $idviaje)
    {   
        $msg="Se ha cancelado su boleto en el viaje y se ha devuelto el 50% de su precio";
        //preguntar si faltan mas de 48Hs: borrar, subir en uno la capacidad del viaje y devolverle el dinero al usuario
        $hoy=date('Y-m-d');
        $diaDelViaje=Viaje::where('id',$idviaje)->select('fecha')->get();
        $diaDelViaje= substr($diaDelViaje,11,10);
        $date = Carbon::now();
        $date = $date->addDays(2);
        $date = $date->format('Y-m-d');

        if($date > $diaDelViaje){
            $msg="Faltan menos de 48Hs para el viaje, no se puede cancelar";
        }
        
        else{
            $cantDisponible=Viaje::where('id', $idviaje)->select('cant disponibles')->get();
            if(strlen($cantDisponible)==24){
                $cantDisponible= substr($cantDisponible,21,1);
            }
            else{
                $cantDisponible= substr($cantDisponible,21,2);
            }
            $cantDisponible= intval($cantDisponible);
            $cantDisponible= $cantDisponible+1;

            Usuarioviaje::where('dniusuario',$dni)->where('idViaje', $idviaje)->delete();
            Viaje::where('id', $idviaje)->update(['cant disponibles'=> $cantDisponible ]);
        }
        $data = DB::table('viajes')->join('usuarioviajes', 'usuarioviajes.idViaje','=','viajes.id')->where('fecha','>', $hoy)->get();
        return view('vistasDeUsuario/viajesDelUsuario')->with(['data'=>$data])->with('msg',$msg);
        
    }

    public function showMisViajesOrdenados()
    {
        $value = request('boton');
        $hoy = date("Y-m-d");
        if ($value == 1){
            $data= Viaje::where("cant disponibles", ">", 0)->where('fecha','>', $hoy)->orderBy('ruta','ASC')->get();
        }
        elseif($value == 2){
            $data= Viaje::where("cant disponibles", ">", 0)->where('fecha','>', $hoy)->orderBy('fecha','ASC')->orderBy('hora','ASC')->get();
        }
        else{
            $data= Viaje::where("cant disponibles", ">", 0)->where('fecha','>', $hoy)->orderBy('precio','ASC')->get();
        }
        return view('home', ['data'=>$data]);
    }

    public function reprogramarViaje($dni, $idviaje)
    {       $Date = date('Y-m-d');
         $tiempo=date('Y-m-d', strtotime($Date. ' + 15 days'));
        $msg="";
         $data = DB::table('viajes')->join('usuarioviajes', 'usuarioviajes.idViaje','=','viajes.id')->where('ruta',$idviaje)->where('fecha','>', $tiempo)->get();
    return view('vistasDeUsuario/reprogramar')->with(['data'=>$data]);
       
    }
}


