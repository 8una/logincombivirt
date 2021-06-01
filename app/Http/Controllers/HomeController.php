<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Viaje;
use App\Calificacion;
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
        $data= Viaje::where("cant disponibles", ">", 0)->get();
        return view('home')->with(['data'=>$data])->with('comments',$comments);
    }

    public function userProfile(Request $request) {
       // echo Auth::user();
        $data= Viaje::where("cant disponibles", ">", 0)->get();
        return view ('userProfile');
    }

