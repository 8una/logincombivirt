<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Viaje;
use App\Calificacion;
use App\Ruta;
use App\Ciudad;

use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    // $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {    
        $items2 = DB::table('items')->update(array(
            'cant'=> 0));
        $msg = "";
        $comments=Calificacion::orderBy('fecha', 'DESC')->get()->take(5);
        $hoy = date("Y-m-d H:i:s");
        $data= Viaje::where("cant disponibles", ">", 0)->where('inicio', '>', $hoy)->get();
        $ruta= Ruta::get();
        $origen= Ciudad::get();
        $destino= Ciudad::get();
        return view('home')->with(['data'=>$data])->with("msg", $msg)->with("request", $request)->with('comments',$comments)->with(['ruta'=>$ruta])->with(['origen'=>$origen])->with(['destino'=>$destino]);
    }


    public function userProfile(Request $request) {
    
        $data= Viaje::where("cant disponibles", ">", 0)->get();

        return view ('userProfile')->with("request", $request);
    }

    public function buscarViaje(Request $request)
    {
        $desde= request('desde');
        $hasta= request('hasta');
        $origen= request('origen');
        $destino= request('destino'); //AGREGAR EL TESTEO DE RUTAS
        $ruta= request('ruta');
        $msg="";
        $hoy= date("Y-m-d H:i:s");
        
        $hora=date("H:i:s");
        $hora= strtotime ('-3 hour', strtotime ($hora));
        $hora = date ( 'H:i:s' , $hora); 
        $desde=$desde." ".$hora;
        
        if ($origen != null){

            if ($desde != null){
                if($hasta != null){
                    $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.inicio", '>=', $desde)->where("viajes.fin",'<=', $hasta)->where('rutas.origen', $origen)->get();
                }
                else{
                    //viajes hasta el infinito con origen dado
                    $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.inicio", '>=', $desde)->where('rutas.origen', $origen)->get();
                }
            }
            else{
                if ($hasta != null){
                    $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.inicio", '>=', $desde)->where('rutas.origen', $origen)->get();
                }
                else{
                    $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where('rutas.origen', $origen)->get();
                }
            }
        }
        else if($destino != null){
                if ($desde != null){
                    if($hasta != null){
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.inicio", '>=', $desde)->where("viajes.fin",'<=', $hasta)->where('rutas.destino', $destino)->get();
                    }
                    else{
                        //viajes hasta el infinito con origen dado
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.inicio", '>=', $desde)->where('rutas.destino', $destino)->get();
                    }
                }
                else{
                    if ($hasta != null){
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.inicio", '>=', $desde)->where('rutas.destino', $destino)->get();
                    }
                    else{
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where('rutas.destino', $destino)->get();
                    }   
                }
            }
        
        else if($ruta != null){
            if ($desde != null){
                if($hasta != null){
                    $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.inicio", '>=', $desde)->where("viajes.fin",'<=', $hasta)->where('rutas.nombreRuta', $ruta)->get();
                }
                else{
                    //viajes hasta el infinito con origen dado
                    $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.inicio", '>=', $desde)->where('rutas.nombreRuta', $ruta)->get();
                }
            }
            else{
                if ($hasta != null){
                    $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.inicio", '>=', $desde)->where('rutas.nombreRuta', $ruta)->get();
                }
                else{
                    $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where('rutas.nombreRuta', $ruta)->get();
                }   
            }
            }
        else 
            if($desde != null){
                if ($hasta != null){
                    $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.inicio", '>=', $desde)->where("viajes.fin",'<=', $hasta)->get();
                    }
                else{
                    //si Hasta es = null
                    $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.inicio", '>=', $desde)->get();
                }
            } 
            else{
                //desde es igual a null
                if ($hasta != null){
                    $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fin",'<=', $hasta)->where("viajes.fecha",'>=', $hoy)->get();
                    }
                else{
                    //si Hasta es = null
                    $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.inicio",'>=', $hoy)->get();
                }     
            }  
        
        $comments=Calificacion::orderBy('fecha', 'DESC')->get()->take(5);
        $ruta= Ruta::get();
        $origen= Ciudad::get();
        $destino= Ciudad::get();
        return view('home')->with(['data'=>$data])->with('comments',$comments)->with(['ruta'=>$ruta])->with(['origen'=>$origen])->with(['destino'=>$destino])->with("request", $request)->with("msg", $msg);
    }


    public function showMisViajesOrdenados()
    {
        $value = request('boton');
        $hoy = date("Y-m-d H:i:s"); 
        $hoy= strtotime ('-3 hour', strtotime ($hoy));
        $hoy = date ( 'Y-m-d H:i:s' , $hoy); 
        if ($value == 1) {
            $data = Viaje::where("cant disponibles", ">", 0)->where('inicio', '>=', $hoy)->orderBy('ruta', 'ASC')->get();
        } elseif ($value == 2) {
            $data = Viaje::where("cant disponibles", ">", 0)->where('inicio', '>=', $hoy)->orderBy('inicio', 'ASC')->orderBy('hora', 'ASC')->get();
        } else {
            $data = Viaje::where("cant disponibles", ">", 0)->where('inicio', '>=', $hoy)->orderBy('precio', 'ASC')->get();
        }
        $msg="";
        $comments=Calificacion::orderBy('fecha', 'DESC')->get()->take(5);
        $ruta= Ruta::get();
        $origen= Ciudad::get();
        $destino= Ciudad::get();
        
        return view('home')->with(['data'=>$data])->with('comments',$comments)->with(['ruta'=>$ruta])->with(['origen'=>$origen])->with(['destino'=>$destino])->with('msg',$msg);
    }



}

