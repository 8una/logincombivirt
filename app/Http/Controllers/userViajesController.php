<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Viaje;
use App\Usuarioviaje;
use App\User;
use App\Calificacion;
use Carbon\Carbon;
use Auth;


class userViajesController extends Controller
{
    public function showMisViajes($dni)
    {
        $hoy = date("Y-m-d");
        $msg = "";
        $data = DB::table('viajes')->join('usuarioviajes', 'usuarioviajes.idViaje', '=', 'viajes.id')->where('dniusuario', $dni)->where('fecha', '>', $hoy)->get();
        return view('vistasDeUsuario/viajesDelUsuario')->with(['data' => $data])->with('msg', $msg);
    }

    public function cancelarViaje($dni, $idviaje)
    {
        $msg = "Se ha cancelado su boleto en el viaje y se ha devuelto el 50% de su precio";
        //preguntar si faltan mas de 48Hs: borrar, subir en uno la capacidad del viaje y devolverle el dinero al usuario
        $hoy = date('Y-m-d');
        $diaDelViaje = Viaje::where('id', $idviaje)->select('fecha')->get();
        $diaDelViaje = substr($diaDelViaje, 11, 10);
        $date = Carbon::now();
        $date = $date->addDays(2);
        $date = $date->format('Y-m-d');

        if ($date > $diaDelViaje) {
            $msg = "Faltan menos de 48Hs para el viaje, no se puede cancelar";
        } else {
            $cantDisponible = Viaje::where('id', $idviaje)->select('cant disponibles')->get();
            if (strlen($cantDisponible) == 24) {
                $cantDisponible = substr($cantDisponible, 21, 1);
            } else {
                $cantDisponible = substr($cantDisponible, 21, 2);
            }
            $cantDisponible = intval($cantDisponible);
            $cantDisponible = $cantDisponible + 1;

            Usuarioviaje::where('dniusuario', $dni)->where('idViaje', $idviaje)->delete();
            Viaje::where('id', $idviaje)->update(['cant disponibles' => $cantDisponible]);
        }
        $data = DB::table('viajes')->join('usuarioviajes', 'usuarioviajes.idViaje', '=', 'viajes.id')->where('dniusuario', $dni)->where('fecha', '>', $hoy)->get();
        return view('vistasDeUsuario/viajesDelUsuario')->with(['data' => $data])->with('msg', $msg);
    }

    public function showMisViajesOrdenados()
    {
        $value = request('boton');
        $hoy = date("Y-m-d");
        if ($value == 1) {
            $data = Viaje::where("cant disponibles", ">", 0)->where('fecha', '>', $hoy)->orderBy('ruta', 'ASC')->get();
        } elseif ($value == 2) {
            $data = Viaje::where("cant disponibles", ">", 0)->where('fecha', '>', $hoy)->orderBy('fecha', 'ASC')->orderBy('hora', 'ASC')->get();
        } else {
            $data = Viaje::where("cant disponibles", ">", 0)->where('fecha', '>', $hoy)->orderBy('precio', 'ASC')->get();
        }
        return view('home', ['data' => $data]);
    }

    public function reprogramarViaje($dni, $ruta, $idviajeviejo)
    {
        $hoy = date('Y-m-d');
        $hoymas15 = date('Y-m-d', strtotime($hoy . ' + 15 days'));
        $msg = "";
        $data = DB::table('viajes')->where('ruta', $ruta)->where('fecha', '>', $hoymas15)->get();

        return view('vistasDeUsuario/reprogramar')->with(['data' => $data, 'idviajeviejo' => $idviajeviejo]);
    }

    public function actualizarViaje($dni, $idusuarioviaje, $idviajenuevo)
    {
        $hoy = date("Y-m-d");
        $data = DB::table('viajes')->join('usuarioviajes', 'usuarioviajes.idViaje', '=', 'viajes.id')->where('dniusuario', $dni)->where('fecha', '>', $hoy)->get();
        $hayEspacio = Viaje::where('id', $idviajenuevo)->value('cant disponibles');
        $Fecha_viaje_nuevo = Viaje::where('id', $idviajenuevo)->value('fecha');
        $Hora_viaje_nuevo = Viaje::where('id', $idviajenuevo)->value('hora');
        $idViajeViejo = Usuarioviaje::where('id', $idusuarioviaje)->value('idViaje');
        $Fecha_viaje_viejo = Viaje::where('id', $idViajeViejo)->value('fecha');
        $Hora_viaje_viejo = Viaje::where('id', $idViajeViejo)->value('hora');
        if ($Fecha_viaje_nuevo == $Fecha_viaje_viejo) {
            if($Hora_viaje_viejo == $Hora_viaje_nuevo) {
                $msg = "Usted ya dispone de un viaje el día $Fecha_viaje_viejo a las $Hora_viaje_viejo.";
                return view('vistasDeUsuario/viajesDelUsuario')->with(['data' => $data])->with('msg', $msg); 
            }

        }  elseif ($hayEspacio > 0) {
        
        Usuarioviaje::where('dniusuario', $dni)->where('id', $idusuarioviaje)->update(array('idViaje' => $idviajenuevo));
        $msg = "Usted ha reprogramado su viaje con éxito";
        return view('vistasDeUsuario/viajesDelUsuario')->with(['data' => $data])->with('msg', $msg);
        }
        else {
            $msg = "El viaje que usted seleccionó no dispone de asientos libres. Por favor, seleccione otro viaje.";
        return view('vistasDeUsuario/viajesDelUsuario')->with(['data' => $data])->with('msg', $msg);
        }
    }


    public function showMisViajesPasados($dni)
    {
        $hoy = date("Y-m-d H:i:s");  
        $msg = "";
        $data = DB::table('viajes')->join('usuarioviajes', 'usuarioviajes.idViaje', '=', 'viajes.id')->where('dniusuario', $dni)->where('viajes.fin', '<', $hoy)->get();
        return view('vistasDeUsuario/viajesDelUsuarioPasados')->with(['data' => $data])->with('msg', $msg);
    }

    public function calificarviaje($viaje)
    {
        return view('vistasDeUsuario/calificarViaje')->with('viaje', $viaje);
    }

    public function usuarioCalificaViaje($idViaje)
    {
        $puntuacion= request('inlineRadioOptions');
        $comentario= request('comentario');
        $nombre= Auth::user()->name;

        Calificacion::create([
            'nombre' => $nombre,
            'calificacion' => $puntuacion,
            'comentario' => $comentario,
            'fecha' => date("Y-m-d H:i:s")
        ]); 

        Usuarioviaje::where('id', $idViaje)->update([
            'estado' => 'calificado'
        ]);
        
        $hoy = date("Y-m-d H:i:s");  
        $msg = "";
        $data = DB::table('viajes')->join('usuarioviajes', 'usuarioviajes.idViaje', '=', 'viajes.id')->where('dniusuario', Auth::user()->DNI)->where('viajes.fin', '<', $hoy)->get();
        return view('vistasDeUsuario/viajesDelUsuario')->with(['data' => $data])->with('msg', $msg);
    }
}
