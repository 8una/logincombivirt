<?php

namespace App\Http\Controllers;
use App\Models\Chofer;
use App\Models\Viaje;
use App\Combi;
use Illuminate\Http\Request;

class ChoferController extends Controller
{
    public function index()
    {
        $choferes = Chofer::get();
        return view("chofer.lista",compact("choferes"));
    }
    public function crearForm()
    {
        $data = '';
        return view('chofer.crear', ['data' =>$data]);
    }
    public function actualizarForm(Chofer $chofer)
    {

        //return view("chofer.actualizar", compact("chofer"));
        $data = '';
        return view('chofer.actualizar')->with('chofer',$chofer)->with('data',$data);
    }
    public function crear(Request $request)
    {
        $msg = "El chofer se cargó con éxito";
        try {
            $request->validate(['nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required',
            'email' => 'required',
            'password' => 'required |min :8|',
            ]);
            //'password' => 'required | regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()+]+.*)[0-9a-zA-Z\w!@#$%^&*()+]{8,}$/',
            $dni = $request->input('dni');
            $cantidadChoferes= Chofer::where("dni", "=", $dni)->count();
            $email = $request->input('email');
            $cantidadChoferes2= Chofer::where("email", "=", $email)->count();
            if ($cantidadChoferes == 0 ){
                if($cantidadChoferes2 == 0){
                    $chofer = new Chofer;
                    $chofer->nombre = $request->input('nombre');
                    $chofer->apellido = $request->input('apellido');
                    $chofer->dni = $request->input('dni');
                    $chofer->email = $request->input('email');
                    $chofer->password = $request->input('password');
                    $chofer->save();
                } 
                else{
                    $msg = "el email ingresado ya esta registrado en el sistema";
                } 
            }
            else{
                $msg = "el dni ingresado ya esta registrado en el sistema";
            }
        } catch (\Exception $th) {
            //$msg = "el dni ingresado no es válido";
            $msg= $th->getMessage();
            /*if (strcmp($msg,"preg_match(): No ending delimiter '/' found" == 0)){
                $msg = "la contraseña ingresada es invalida. Debe tener al menos: 8 caracteres";
            }*/
        }        
        return view('chofer.crear', ['data' =>$msg]);
        //return redirect()->route('chofer.index');      
    }
    public function actualizar(Chofer $chofer)
    {       
        $msg = "el chofer se actualizó con éxito";
        try {
            $chofer->update([
                'nombre'=>request('nombre'),
                'apellido'=>request('apellido'),
                'dni'=>request('dni'),
                'email'=>request('email'),
                'password'=>request('password'),
            ]);
            //return redirect()->route('chofer.index');
        } catch (\Illuminate\Database\QueryException $th) {
            /*$needle = 'chofer_dni_unique';
            if (str_contains($th, $needle)) {
                $error = 'el dni ingresado ya esta registrado en el sistema';
            }
            else{
                $needle = 'chofer_email_unique';
                if (str_contains($th,$needle)){
                    $error = 'el email ingresado ya esta registrado en el sistema';
                }
                else{
                    $error = 'el dni ingresado es invalido';
                }
            }*/
            $msg= $th->getMessage();
            if ($chofer->DNI != request('dni')){
                $cantChoferes = Chofer::where("dni", "=", request('dni'))->count();
                if ($cantChoferes == 1){
                    $msg = "el dni ingresado ya se encuentra registrado en el sistema";
                }                
            }
            else{
                if (strcmp($chofer->email,request('email')) == 0){
                    $cantChoferes2 = Chofer::where("email", "=", request('email'))->count();
                    if ($cantChoferes2 == 1){
                        $msg = "el email ingresado ya se encuentra registrado en el sistema";
                    }
    
                }
            }          
            //return redirect()->route('chofer.index');
        }   
        return view("chofer.actualizar", ["data"=>$msg,"chofer"=>$chofer]);
    }
    public function eliminar(Chofer $chofer)
    {
        $chofer->delete();
        return redirect()->route('chofer.index');
    }
    
    public function perfil(Chofer $chofer)
    {
        $viajes = Viaje::where('DNI','=',$chofer->DNI)->get();
        /*return view('chofer.perfil', ['viajes' =>$viajes,
        'chofer'=> $chofer]);*/
        return view('chofer.perfil')->with('chofer',$chofer)->with('viajes',$viajes);
       // return view('chofer.perfil',compact('chofer','viajes'));
    }

}