<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Viaje;
use App\Usuarioviaje;
use App\User;
use App\Calificacion;
use Carbon\Carbon;
use App\Models\Marcados;
use App\Models\Item;
use App\Models\ItemViaje;
use App\Ruta;
use App\Ciudad;
use Auth;
use App\Models\Suscriptores;



class userViajesController extends Controller
{
    public function subscripcion(Request $request)
    {
        $user = Auth::user();
        $numeroTarjeta = request('numero');
        if ($numeroTarjeta % 10 < 5){
            #tiene saldo
            Suscriptores::create([
                'dni' => $user->dni,
                'nroTarjeta' => $numeroTarjeta,
            ]); 
            $comments=Calificacion::orderBy('fecha')->get()->take(5);
                $hoy = date("Y-m-d H:i:s");
                $data= Viaje::where("cant disponibles", ">", 0)->where('inicio', '>', $hoy)->get();
                $hoy = date("Y-m-d H:i:s");
                $ruta= Ruta::get();
                $origen= Ciudad::get();
                $destino= Ciudad::get();
                $msg = "Felicidades! Se realizó la suscripción con éxito!";
                return view('home')->with(['data'=>$data])->with("request", $request)->with("msg", $msg)->with('comments',$comments)->with(['ruta'=>$ruta])->with(['origen'=>$origen])->with(['destino'=>$destino]);
        }
        else{
            $data = "la tarjeta ingresada no tiene saldo suficiente";
            return view('vistasDeUsuario/subscripcion')->with(['data' => $data]);
        }
    }

    public function anularSus(Request $request)
    {
        $user = Auth::user();
        $delete = Suscriptores::where('dni',$user->dni)->delete();
        $comments=Calificacion::orderBy('fecha')->get()->take(5);
                $hoy = date("Y-m-d H:i:s");
                $data= Viaje::where("cant disponibles", ">", 0)->where('inicio', '>', $hoy)->get();
                $hoy = date("Y-m-d H:i:s");
                $ruta= Ruta::get();
                $origen= Ciudad::get();
                $destino= Ciudad::get();
                $msg = "Realizó la anulación de suscripción con éxito";
                return view('home')->with(['data'=>$data])->with("request", $request)->with("msg", $msg)->with('comments',$comments)->with(['ruta'=>$ruta])->with(['origen'=>$origen])->with(['destino'=>$destino]);
    }

    public function subscribirseForm(Request $request)
    {
        if (Auth::check()){
            $user = Auth::user();
            $sub = Suscriptores::where('dni',$user->dni);
            if ($sub->count() == 0){
                $data = "";
                return view('vistasDeUsuario/subscripcion')->with(['data' => $data]);
            }
            else{
                /*$comments=Calificacion::orderBy('fecha')->get()->take(5);
                $hoy = date("Y-m-d H:i:s");
                $data= Viaje::where("cant disponibles", ">", 0)->where('inicio', '>', $hoy)->get();
                $hoy = date("Y-m-d H:i:s");
                $ruta= Ruta::get();
                $origen= Ciudad::get();
                $destino= Ciudad::get();
                $msg = "usted ya se encuentra suscripto";
                return view('home')->with(['data'=>$data])->with("request", $request)->with("msg", $msg)->with('comments',$comments)->with(['ruta'=>$ruta])->with(['origen'=>$origen])->with(['destino'=>$destino]);*/
                $tarjetasArray = [];
                $tarjetas= Suscriptores::where('dni','=', Auth::user()->dni)->select('nroTarjeta')->get();
                $data= "usted ya se encuentra suscripto";
                foreach ($tarjetas as $tarjetas){
                    $tarjetas = substr($tarjetas, 14, 10);
                    $tarjetas = substr_replace($tarjetas, '*******', 0, 7);
                    array_push($tarjetasArray , $tarjetas);
                }
                return view('vistasDeUsuario/showTarjetas')->with(['data' => $data])->with(['tarjetas' => $tarjetasArray]);
            }
        }
        else{
            #retornar a la vista de login
            return view ('auth.login');
        }   
    }
    public function showMisViajes($dni)
    {
        $hoy = date("Y-m-d H:i:s"); 
        $msg = "";
        $data = DB::table('viajes')->join('usuarioviajes', 'usuarioviajes.idViaje', '=', 'viajes.id')->where('dniusuario', $dni)->where('inicio', '>', $hoy)->get();
        return view('vistasDeUsuario/viajesDelUsuario')->with(['data' => $data])->with('msg', $msg);
    }



    public function agregarViajeAUsuario2 (Viaje $viaje, Request $request)
    {
        $numeroTarjeta = request('numero');
        $usuario = Auth::user();
        $dni = $usuario->dni;
        $numeroTarjeta = substr($numeroTarjeta, -3); 
        $num = (int)$numeroTarjeta;
        //lineas de thomas
        $hoy = date("Y-m-d H:i:s"); 
        $hoy= strtotime ('-3 hour', strtotime ($hoy));
        $hoy = date ( 'Y-m-d H:i:s' , $hoy); 
        //fin


        if ($num % 10 < 5){
            #tiene saldo
            Usuarioviaje::create([
                'dniusuario' => $dni,
                'idViaje' => $viaje->id,
                'estado' => "pendiente",
            ]); 
            $cantLibres=Viaje::where('id','=',$viaje->id)->value('cant disponibles');
            $cantLibres -= 1;
            Viaje::where('id','=',$viaje->id)->update([
                'cant disponibles'=> $cantLibres,
            ]);
            #para que retorne al home despues del pago
            $msg = "se compró el viaje exitosamente!";
            $comments=Calificacion::orderBy('fecha')->get()->take(5);
            $data= Viaje::where("cant disponibles", ">", 0)->where('inicio', '>', $hoy)->get();
            $ruta= Ruta::get();
                    $origen= Ciudad::get();
                    $destino= Ciudad::get();
                    return view('home')->with(['data'=>$data])->with("msg", $msg)->with("request", $request)->with('comments',$comments)->with(['ruta'=>$ruta])->with(['origen'=>$origen])->with(['destino'=>$destino]);
                }
        else{
            $data = "la tarjeta ingresada no tiene saldo suficiente";
            #notienesaldo

            $tarjetasArray = [];
            $tarjetas= Suscriptores::where('dni','=', Auth::user()->dni)->select('nroTarjeta')->get();
            foreach ($tarjetas as $tarjetas){
                $tarjetas = substr($tarjetas, 14, 10);
                $tarjetas = substr_replace($tarjetas, '*******', 0, 7);
                array_push($tarjetasArray , $tarjetas);
            }

            return view('vistasDeUsuario.pagarTarjetasSub')->with(['viaje' => $viaje])->with('data', $data)->with('tarjetas', $tarjetasArray);
        }

    }
    public function agregarViajeAUsuario(Viaje $viaje, Request $request)
    {
        $numeroTarjeta = request('numero');
        $usuario = Auth::user();
        $dni = $usuario->dni;

        //lineas de thomas
        $hoy = date("Y-m-d H:i:s"); 
        $hoy= strtotime ('-3 hour', strtotime ($hoy));
        $hoy = date ( 'Y-m-d H:i:s' , $hoy); 
        //fin


        if ($numeroTarjeta % 10 < 5){
            #tiene saldo
            Usuarioviaje::create([
                'dniusuario' => $dni,
                'idViaje' => $viaje->id,
                'estado' => "pendiente",
            ]); 
            $cantLibres=Viaje::where('id','=',$viaje->id)->value('cant disponibles');
            $cantLibres -= 1;
            Viaje::where('id','=',$viaje->id)->update([
                'cant disponibles'=> $cantLibres,
            ]);
            #para que retorne al home despues del pago
            $msg = "se compró el viaje exitosamente!";
            $comments=Calificacion::orderBy('fecha')->get()->take(5);
            $data= Viaje::where("cant disponibles", ">", 0)->where('inicio', '>', $hoy)->get();
            $ruta= Ruta::get();
                    $origen= Ciudad::get();
                    $destino= Ciudad::get();
                    return view('home')->with(['data'=>$data])->with("msg", $msg)->with("request", $request)->with('comments',$comments)->with(['ruta'=>$ruta])->with(['origen'=>$origen])->with(['destino'=>$destino]);
                }
        else{
            $data = "la tarjeta ingresada no tiene saldo suficiente";
            #notienesaldo

            

            return view('vistasDeUsuario.tarjeta')->with(['viaje' => $viaje])->with('data', $data);
        }

    }
    
    public function showAgregarTarjeta()
    {
        $msg="";
        return view('vistasDeUsuario/agregarTarjeta')->with('msg', $msg);
    }

    public function agregarTarjeta(Request $request)
    {
        $tarjetas = Suscriptores::where('dni', '=', Auth::user()->dni)->where('nroTarjeta', '=', request('numero'))->get()->count();
        if ($tarjetas > 0){
            $msg = "La tarjeta de credito ya esta ingresada";
            return view('vistasDeUsuario/agregarTarjeta')->with('msg', $msg);
        }
        $numeroTarjeta = request('numero');

        if ($numeroTarjeta % 10 < 5){
            #numero de tarjeta valido
            Suscriptores::create([
                'dni' => Auth::user()->dni,
                'nroTarjeta' => $numeroTarjeta,
            ]); 
            $tarjetasArray = [];
            $tarjetas= Suscriptores::where('dni','=', Auth::user()->dni)->select('nroTarjeta')->get();
            foreach ($tarjetas as $tarjetas){
                $tarjetas = substr($tarjetas, 14, 10);
                $tarjetas = substr_replace($tarjetas, '*******', 0, 7);
                array_push($tarjetasArray , $tarjetas);
            }
            $data = "";
            return view('vistasDeUsuario/showTarjetas')->with(['data' => $data])->with(['tarjetas' => $tarjetasArray]);
        }
        else{
            #numero de tarjeta invalido
            $msg = "la tarjeta ingresada es invalida";
            return view('vistasDeUsuario/agregarTarjeta')->with('msg', $msg);
        }
    }

    public function formPagoOtraTarjeta(Viaje $viaje)
    {
        $data = "";
        
        
         return view('vistasDeUsuario.tarjeta')->with(['viaje' => $viaje])->with('data', $data);
        
        
    }
    public function formPago(Viaje $viaje)
    {
        $data = "";
        $usuario = Auth::user();
        $dni = $usuario->dni;
        $suscriptor = Suscriptores::where('dni',$dni)->get();
        //$tarjetas = Suscriptores::where('dni',$dni)->get();

        $tarjetasArray = [];
        $tarjetas= Suscriptores::where('dni','=', Auth::user()->dni)->select('nroTarjeta')->get();
        foreach ($tarjetas as $tarjetas){
            $tarjetas = substr($tarjetas, 14, 10);
            $tarjetas = substr_replace($tarjetas, '*******', 0, 7);
            array_push($tarjetasArray , $tarjetas);
        }


        if ($suscriptor->count() > 0){
            return view('vistasDeUsuario.pagarTarjetasSub')->with(['viaje' => $viaje])->with('data', $data)->with('tarjetas', $tarjetasArray);
        }
        else{
            return view('vistasDeUsuario.tarjeta')->with(['viaje' => $viaje])->with('data', $data);
        }
        
    }

    public function comprarViaje(Viaje $viaje, Request $request)
    {
        $msg = "";
        
        
        if (Auth::check()){
            $hoy = date('Y-m-d');
            $usuario = Auth::user();
            $dni = $usuario->dni;
            $usuarioM = Marcados::where('DNI',$dni)->get();
            if ($usuarioM->count() == 0 ){       
                $usuario2=DB::table('users')->where('users.dni','=',$dni)->whereNotExists(function ($query) use ($viaje) {
                    $fecha = $viaje->fecha;
                    $hora = $viaje->hora;
                    $fechaInicio= date ('Y-m-d H:i:s', (strtotime( $fecha.$hora)));
                    $fechaFin = strtotime ( '+'.$viaje->duracion.' hour' , strtotime ($fechaInicio)) ; 
                    $fechaFin = date ( 'Y-m-d H:i:s' , $fechaFin);  
                    $query->select(DB::raw(1))
                        ->from('usuarioViajes')                                                    
                        ->whereColumn('users.dni', 'usuarioViajes.dniusuario')->join('viajes','usuarioViajes.idViaje','=','viajes.id')->whereBetween('viajes.inicio',[$fechaInicio,$fechaFin])
                        ->orWhereColumn('users.dni', 'usuarioViajes.dniusuario')->whereBetween('viajes.fin',[$fechaInicio,$fechaFin])
                        ->orWhereColumn('users.dni', 'usuarioViajes.dniusuario')->where('viajes.inicio','<', $fechaInicio)->where('viajes.fin','>', $fechaInicio)
                        ->orWhereColumn('users.dni', 'usuarioViajes.dniusuario')->where('viajes.inicio','>', $fechaInicio)->where('viajes.fin','<', $fechaInicio);
                })->distinct()->select('dni')->get();
                
                if ($usuario2->count() > 0){
                    
                    #ir a la vista de items
                    
                    $items = Item::get();    
                    $suscriptor = Suscriptores::where('dni',$dni)->get();
                    $cantItem = 0;
                    if ($suscriptor->count() > 0){
                        #se realiza el descuento
                        $precioTotal = $viaje->precio * 0.1;
                        $precioTotal = $viaje->precio - $precioTotal;
                        $msg = "Se realizó un 10% de descuento por ser usuario suscriptor";
                        return view('item.itemVentas')->with(['items' => $items])->with(['viaje' => $viaje])->with(['precioTotal' =>$precioTotal])->with('msg',$msg);
                    }
                    $precioTotal = $viaje->precio ;
                    $msg = "";
                    return view('item.itemVentas')->with(['items' => $items])->with(['viaje' => $viaje])->with(['precioTotal' =>$precioTotal])->with('msg',$msg);
                }
                else{
                    $msg = "no puede comprar el viaje seleccionado porque se superpone con otro que tiene pendiente";
                    #retornar a la misma vista con este msg
                    $comments=Calificacion::orderBy('fecha')->get()->take(5);
                    $data= Viaje::where("cant disponibles", ">", 0)->where('inicio', '>', $hoy)->get();
                    $hoy = date("Y-m-d H:i:s");
                    $ruta= Ruta::get();
                    $origen= Ciudad::get();
                    $destino= Ciudad::get();
                    return view('home')->with(['data'=>$data])->with("request", $request)->with("msg", $msg)->with('comments',$comments)->with(['ruta'=>$ruta])->with(['origen'=>$origen])->with(['destino'=>$destino]);
                }
            }
            else {
                $usuarioM2 = Marcados::where('DNI',$dni)->where('fechaFin','>=',$viaje->fecha)->where('fechaInicio','<=',$viaje->fecha)->get();
                if ($usuarioM2->count() > 0){
                    $fech = Marcados::where('DNI',$dni)->where('fechaFin','>=',$viaje->fecha)->value('fechaFin');
                    $msg = "No puede comprar el viaje porque esta marcado como sospechoso de covid. Puede comprar después de la fecha ".$fech;
                    #retornar a la misma vista con este mensaje
                    $comments=Calificacion::orderBy('fecha')->get()->take(5);
                    $data= Viaje::where("cant disponibles", ">", 0)->where('inicio', '>', $hoy)->get();
                    $hoy = date("Y-m-d H:i:s");
                    $ruta= Ruta::get();
                    $origen= Ciudad::get();
                    $destino= Ciudad::get();
                    return view('home')->with(['data'=>$data])->with("msg", $msg)->with("request", $request)->with('comments',$comments)->with(['ruta'=>$ruta])->with(['origen'=>$origen])->with(['destino'=>$destino]);
                }
                else{
                    
                    $usuario2=DB::table('users')->where('users.dni','=',$dni)->whereNotExists(function ($query) use ($viaje) {
                        $fecha = $viaje->fecha;
                        $hora = $viaje->hora;
                        $fechaInicio= date ('Y-m-d H:i:s', (strtotime( $fecha.$hora)));
                        $fechaFin = strtotime ( '+'.$viaje->duracion.' hour' , strtotime ($fechaInicio)) ; 
                        $fechaFin = date ( 'Y-m-d H:i:s' , $fechaFin);  
                        $query->select(DB::raw(1))
                            ->from('usuarioViajes')                                                    
                            ->whereColumn('users.dni', 'usuarioViajes.dniusuario')->join('viajes','usuarioViajes.idViaje','=','viajes.id')->whereBetween('viajes.inicio',[$fechaInicio,$fechaFin])
                            ->orWhereColumn('users.dni', 'usuarioViajes.dniusuario')->whereBetween('viajes.fin',[$fechaInicio,$fechaFin])
                            ->orWhereColumn('users.dni', 'usuarioViajes.dniusuario')->where('viajes.inicio','<', $fechaInicio)->where('viajes.fin','>', $fechaInicio)
                            ->orWhereColumn('users.dni', 'usuarioViajes.dniusuario')->where('viajes.inicio','>', $fechaInicio)->where('viajes.fin','<', $fechaInicio);
                    })->distinct()->select('dni')->get();
                    
                    if ($usuario2->count() > 0){
                        #ir a la vista de items
                        
                        $items = Item::get();    
                        $suscriptor = Suscriptores::where('dni',$dni)->get();
                        $cantItem = 0;
                        if ($suscriptor->count() > 0){
                            #se realiza el descuento
                            $precioTotal = $viaje->precio * 0.1;
                            $precioTotal = $viaje->precio - $precioTotal;
                            $msg = "Se realizó un 10% de descuento por ser usuario suscriptor";
                            return view('item.itemVentas')->with(['items' => $items])->with(['viaje' => $viaje])->with(['precioTotal' =>$precioTotal])->with('msg',$msg);
                        }
                        $precioTotal = $viaje->precio ;
                        $msg = "";
                        return view('item.itemVentas')->with(['items' => $items])->with(['viaje' => $viaje])->with(['precioTotal' =>$precioTotal])->with('msg',$msg);

                    }
                    else{
                        $msg = "no puede comprar el viaje seleccionado porque se superpone con otro que tiene pendiente";
                        #retornar a la misma vista con este msg
                        $comments=Calificacion::orderBy('fecha')->get()->take(5);
                        $data= Viaje::where("cant disponibles", ">", 0)->where('inicio', '>', $hoy)->get();
                        $hoy = date("Y-m-d H:i:s");
                    $ruta= Ruta::get();
                    $origen= Ciudad::get();
                    $destino= Ciudad::get();
                    return view('home')->with(['data'=>$data])->with("msg", $msg)->with("request", $request)->with('comments',$comments)->with(['ruta'=>$ruta])->with(['origen'=>$origen])->with(['destino'=>$destino]);
                }
                }      
            }
        }    
        else{
            #retornar a la vista de login
            return view ('auth.login');
        }
        
    }
    public function compraItems(Viaje $viaje)
    {
        $msg = "";
        if (Auth::check()){
            $hoy = date('Y-m-d');
            $usuario = Auth::user();
            $dni = $usuario->DNI;
            $usuarioM = Marcados::where('DNI','=',$dni)->where('fechaFin','<',$hoy)->get();
            if ($usuarioM->count() > 0){
                $msg = "no puede comprar el viaje porque esta marcado como sospechoso de covid";
                #retornar a la misma vista con este mensaje
            }
            else{
                
                $usuario2=DB::table('users')->where('users.dni','=',$dni)->whereNotExists(function ($query) use ($viaje) {
                    $fecha = $viaje->fecha;
                    $hora = $viaje->hora;
                    $fechaInicio= date ('Y-m-d H:i:s', (strtotime( $fecha.$hora)));
                    $fechaFin = strtotime ( '+'.$viaje->duracion.' hour' , strtotime ($fechaInicio)) ; 
                    $fechaFin = date ( 'Y-m-d H:i:s' , $fechaFin);  
                    $query->select(DB::raw(1))
                        ->from('usuarioViajes')                                                    
                        ->whereColumn('users.DNI', 'usuarioViajes.dniusuario')->join('viajes','usuarioViajes.idViaje','=','viajes.id')->whereBetween('viajes.inicio',[$fechaInicio,$fechaFin])
                        ->orWhereColumn('users.DNI', 'usuarioViajes.dniusuario')->whereBetween('viajes.fin',[$fechaInicio,$fechaFin])
                        ->orWhereColumn('users.DNI', 'usuarioViajes.dniusuario')->where('viajes.inicio','<', $fechaInicio)->where('viajes.fin','>', $fechaInicio)
                        ->orWhereColumn('users.DNI', 'usuarioViajes.dniusuario')->where('viajes.inicio','>', $fechaInicio)->where('viajes.fin','<', $fechaInicio);
                })->distinct()->select('DNI')->get();
                if ($usuario2->count() > 0){
                    #retornar a la vista de items
                    $items = Item::get();
                    return view('item.itemVentas')->with(['items' => $items])->with(['viaje' => $viaje]);
                }
            }         
        }
        else{
            #retornar a la vista de login
            return view ('auth.login');
        }
        
    }


    public function agregarItemAViaje(Item $item,Viaje $viaje,$precioTotal)
        {
            $usuario = Auth::user();
            $dni = $usuario->dni;
            ItemViaje::create([
                'DNI' => $dni,
                'nombreItem' => $item->nombre,
                'precioItem' => $item->precio,
                'idViaje' => $viaje->id,
            ]); 

            $usuario = Auth::user();
            $suscriptor = Suscriptores::where('dni',$usuario->dni)->get();
            if ($suscriptor->count() > 0){
                $msg = "Se realizó un 10% de descuento por ser usuario suscriptor";
                $itemDescontado = $item->precio - ($item->precio * 0.1); 
                $precioTotal = $precioTotal + $itemDescontado;
            }
            else{
                $msg = "";
                $precioTotal = $precioTotal + $item->precio;
            }

            $cantItem=Item::where('nombre','=',$item->nombre)->value('cant');

            $cantItem += 1;
            Item::where('nombre','=',$item->nombre)->update([
                'cant'=> $cantItem,
            ]);
            $items = Item::get();
            return view('item.itemVentas')->with(['items' => $items])->with(['viaje' => $viaje])->with(['precioTotal' =>$precioTotal])->with('msg',$msg);
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

    public function sacarItemAViaje(Item $item,Viaje $viaje,$precioTotal)
        {
            $itemViaje = ItemViaje::where('nombreItem',$item->nombre);
            $itemViaje->delete();
            $usuario = Auth::user();
            $suscriptor = Suscriptores::where('dni',$usuario->dni)->get();
            if ($suscriptor->count() > 0){
                $msg = "Se realizó un 10% de descuento por ser usuario suscriptor";
                $itemDescontado = $item->precio - ($item->precio * 0.1); 
                $precioTotal = $precioTotal - $itemDescontado;
            }
            else{
                $msg = "";
                $precioTotal = $precioTotal - $item->precio;
            }
            $cantItem=Item::where('nombre','=',$item->nombre)->value('cant');
            $cantItem -= 1;
            Item::where('nombre','=',$item->nombre)->update([
                'cant'=> $cantItem,
            ]);
            $items = Item::get();
            return view('item.itemVentas')->with(['items' => $items])->with(['viaje' => $viaje])->with(['precioTotal' =>$precioTotal])->with('msg',$msg);

        }

    public function reprogramarViaje($dni, $ruta, $idviajeviejo)
    {
        /* $infectado=  */
        $fin=Marcados::where('DNI',$dni)->value('fechaFin');
        if ($fin != null){
            $diaDeViaje= $fin;
        }
        else{
            $diaDeViaje= Viaje::where(id,$idviajeviejo)->select('fecha')->get();
            }
        $msg = "";
        $data = DB::table('viajes')->where('ruta', $ruta)->where('fecha', '>', $diaDeViaje)->get();

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

        /* Superposivcion horaria */
       /*  $data=DB::table('chofers')->whereNotExists(function ($query) {
            $fechaInicio= date ('Y-m-d H:i:s', (strtotime( request('fecha').request('hora'))));
            $fechaFin = strtotime ( '+'.request('duracion').' hour' , strtotime ($fechaInicio)) ; 
            $fechaFin = date ( 'Y-m-d H:i:s' , $fechaFin);  
            $query->select(DB::raw(1))
                ->from('viajes')                                                    
                ->whereColumn('chofers.DNI', 'viajes.DNI')->whereBetween('viajes.inicio',[$fechaInicio,$fechaFin])
                ->orWhereColumn('chofers.DNI', 'viajes.DNI')->whereBetween('viajes.fin',[$fechaInicio,$fechaFin])
                ->orWhereColumn('chofers.DNI', 'viajes.DNI')->where('viajes.inicio','<', $fechaInicio)->where('viajes.fin','>', $fechaInicio)
                ->orWhereColumn('chofers.DNI', 'viajes.DNI')->where('viajes.inicio','>', $fechaInicio)->where('viajes.fin','<', $fechaInicio);
        })->distinct()->select('DNI')->get(); */
        /* Superposivcion horaria */
        
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
        $data = DB::table('viajes')->join('usuarioviajes', 'usuarioviajes.idViaje', '=', 'viajes.id')->where('dniusuario', Auth::user()->dni)->where('viajes.fin', '<', $hoy) ->get();
        return view('vistasDeUsuario/viajesDelUsuarioPasados')->with(['data' => $data])->with('msg', $msg);
    }


}
