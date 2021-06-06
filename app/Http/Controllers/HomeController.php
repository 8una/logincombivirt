<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Viaje;
use App\Calificacion;
use App\Ruta;
use App\Ciudad;
use DB;
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
        $comments=Calificacion::orderBy('fecha')->get()->take(5);
        $hoy = date("Y-m-d H:i:s");
        $data= Viaje::where("cant disponibles", ">", 0)->where('inicio', '>', $hoy)->get();
        $ruta= Ruta::get();
        $origen= Ciudad::get();
        $destino= Ciudad::get();
        return view('home')->with(['data'=>$data])->with(['request'=>$request])->with('comments',$comments)->with(['ruta'=>$ruta])->with(['origen'=>$origen])->with(['destino'=>$destino]);
    }

    public function userProfile(Request $request) {
    
        $data= Viaje::where("cant disponibles", ">", 0)->get();

        return view ('userProfile');
    }

    public function buscarViaje()
    {
        $desde= request('desde');
        $hasta= request('hasta');
        $origen= request('origen');
        $destino= request('destino');
        if($origen != 'N/A'){
            if ($destino !='N/A'){
                if ($desde != null){
                    if ($hasta != null){
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', $desde)->where("viajes.fin",'<=', $hasta)->where('rutas.origen', $origen)->where('rutas.destino', $destino)->get();
                    }
                    else{
                        //viajes desde la ffecha en hasta el infinito
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', $desde)->where('rutas.origen', $origen)->where('rutas.destino', $destino)->get();
                    }
                }
                else{
                    if($hasta != null){
                        //viajes donde no tengo inicio pero tengo fin
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', date("Y-m-d"))->where("viajes.fin",'<=', $hasta)->where('rutas.origen', $origen)->where('rutas.destino', $destino)->get();
                    }
                    else{
                        //viajes donde no tengo ni inicio ni fin
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', date("Y-m-d"))->where('rutas.origen', $origen)->where('rutas.destino', $destino)->get();
                    }
                }
            }
            else{
                //viajes donde no tengo destino
                if ($desde != null){
                    if ($hasta != null){
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', $desde)->where("viajes.fin",'<=', $hasta)->where('rutas.origen', $origen)->get();
                    }
                    else{
                        //viajes desde la ffecha en hasta el infinito
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', $desde)->where('rutas.origen', $origen)->get();
                    }
                }
                else{
                    if($hasta != null){
                        //viajes donde no tengo inicio pero tengo fin
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', date("Y-m-d"))->where("viajes.fin",'<=', $hasta)->where('rutas.origen', $origen)->get();
                    }
                    else{
                        //viajes donde no tengo ni inicio ni fin
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', date("Y-m-d"))->where('rutas.origen', $origen)->get();
                    }
                }
            }
        }
        else{
            if ($destino !='N/A'){
                if ($desde != null){
                    if ($hasta != null){
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', $desde)->where("viajes.fin",'<=', $hasta)->where('rutas.destino', $destino)->get();
                    }
                    else{
                        //viajes desde la ffecha en hasta el infinito
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', $desde)->where('rutas.destino', $destino)->get();
                    }
                }
                else{
                    if($hasta != null){
                        //viajes donde no tengo inicio pero tengo fin
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', date("Y-m-d"))->where("viajes.fin",'<=', $hasta)->where('rutas.destino', $destino)->get();
                    }
                    else{
                        //viajes donde no tengo ni inicio ni fin
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', date("Y-m-d"))->where('rutas.destino', $destino)->get();
                    }
                }
                }
            else{
                //viajes donde no tengo destino
                if ($desde != null){
                    if ($hasta != null){
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', $desde)->where("viajes.fin",'<=', $hasta)->get();
                    }
                    else{
                        //viajes desde la ffecha en hasta el infinito
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', $desde)->get();
                    }
                }
                else{
                    if($hasta != null){
                        //viajes donde no tengo inicio pero tengo fin
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', date("Y-m-d"))->where("viajes.fin",'<=', $hasta)->get();
                    }
                    else{
                        //viajes donde no tengo ni inicio ni fin
                        $data=DB::table('viajes')->join('rutas', 'rutas.nombreRuta', '=', 'viajes.ruta')->where("viajes.cant disponibles", ">", 0)->where("viajes.fecha", '>=', date("Y-m-d"))->get();
                    }
                }
            }
        }
        $comments=Calificacion::orderBy('fecha')->get()->take(5);
        $ruta= Ruta::get();
        $origen= Ciudad::get();
        $destino= Ciudad::get();
        return view('home')->with(['data'=>$data])->with('comments',$comments)->with(['ruta'=>$ruta])->with(['origen'=>$origen])->with(['destino'=>$destino]);
    }
}

