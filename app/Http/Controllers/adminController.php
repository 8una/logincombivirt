<?php

namespace App\Http\Controllers;
use App\Combi;
use App\Models\Viaje;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function show()
    {
        return view("vistasDeAdmin/homeAdmin");
    }

    public function showGestionCombis(){
 
        $data=Combi::all();
        return view('vistasDeAdmin/gestionDeCombis', ['data' =>$data]);
    }

    public function showCrearCombi(){
        $data = '';
        return view('vistasDeAdmin/crearCombi', ['data' =>$data]);
    }



    public function store()
    {
        $patente = request('patente');
        $tipoCombi = request('tipo');
        $capacidad =0;

        $msg="La Patente se cargo con exito";
        if ($tipoCombi == '1'){
            $capacidad = 20;
            $tipoCombi = 'comoda';
        }
        else{
            $capacidad = 22;
            $tipoCombi = 'super-comoda';
        }
        
        $cantidad= Combi::where("patente", "=", $patente)->count();
        $patente=strtoupper($patente);
        $patente=trim($patente);
        //CODIGO DE VALIDACION DE PATENTEBlade::component
        $resultado = false;
        $parteNum = '';
        $parteStr ='';

        if (strlen($patente) == 6){
            $parteStr= substr($patente, 0, 3);
            $parteNum= substr($patente, 3, 3);
        } 
        if (strlen($patente) == 7){
            $parteStr= substr($patente, 0, 2);
            $parteNum= substr($patente, 2, 3);
            $parteStr= $parteStr.substr($patente, 5, 2);
        }
        if ((is_numeric($parteNum))&&(is_string($parteStr))){
            $resultado=true;
        }
        //FIN CODIGO VALIDACION
        
        if ($cantidad == 0 ){
            if($resultado){
                
                Combi::create ([
                    'cant asientos' => $capacidad,
                    'patente'=> $patente,
                    'tipo' => $tipoCombi,
                    ]);
            }
            else{
                $msg="La patente es invalida.";
            }
        }
        else{
            $msg=" La patente ya existe";
        }
        return view('vistasDeAdmin/crearCombi', ['data' =>$msg]);
        
    }


    public function destroy($id)
    {
        $hoy = date("Y-m-d");
        $patente = Combi::where('id',$id)->get('patente');
        if (strlen($patente)==22){
            $patente= substr($patente, 13,6);
        }
        else{
            $patente= substr($patente, 13,7);
        }
        $cantidadViajesFuturos= Viaje::where('patente', $patente)->where('fecha','>',$hoy)->count();
        if ($cantidadViajesFuturos == 0){
            Combi::where('id',$id)->delete();
        }
        return redirect()->route('gestionDeCombis');
    }  



    public function showActCombi($combi)
    {
        $tipo = Combi::where('id',$combi)->get('tipo');
        if (strlen($tipo)==25){
            $tipo = substr($tipo,10,12 );
        }
        else {
            $tipo = substr($tipo, 10,6);
        }

        $patente = Combi::where('id',$combi)->get('patente');
        if (strlen($patente)==22){
            $patente= substr($patente, 13,6);
        }
        else{
            $patente= substr($patente, 13,7);
        }
        if ($tipo == 'comoda' ){
            Combi::where('id',$combi)->update([
                'tipo' => 'super-comoda',
                'cant asientos' => '22',
                'patente' => $patente,
            ]);
        }
        else{
            Combi::where('id',$combi)->update([
                'tipo' => 'comoda',
                'cant asientos' => '20',
                'patente' => $patente,
            ]);
        }
        return redirect()->route('gestionDeCombis');  
    } 
}

    