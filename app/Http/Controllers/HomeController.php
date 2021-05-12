<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viaje;
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
    public function index()
    {
        $data= Viaje::where("cant disponibles", ">", 0)->get();
        return view('home', ['data'=>$data]);
    }

    public function userProfile() {
        $data= Viaje::where("cant disponibles", ">", 0)->get();
        return view ('userProfile');
    }
}
