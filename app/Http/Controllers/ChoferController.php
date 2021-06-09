<?php

namespace App\Http\Controllers;
use App\Models\Chofer;
use App\Models\Viaje;
use App\Combi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChoferController extends Controller
{
    public function index(Request $request)
    {
        $msg = "";
        $choferes = Chofer::get();
        return view('chofer.lista')->with(['choferes' =>$choferes])->with('msg',$msg)->with('request', $request);
    }
    public function crearForm(Request $request)
    {
        $data = '';
        return view('chofer.crear', ['data' =>$data])->with('request', $request);
    }
    public function actualizarForm(Chofer $chofer, Request $request)
    {

        //return view("chofer.actualizar", compact("chofer"));
        $data = '';
        return view('chofer.actualizar')->with('chofer',$chofer)->with('data',$data)->with('request', $request);
    }
    public function crear(Request $request)
    {
        $msg = "El chofer se cargó con éxito";
        try {
            $request->validate(['nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required',
            'email' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@"$!%*#?&]/'],
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
            if(!is_int(request('dni'))){
                $msg = "el dni ingresado es invalido";
            }
            
            else{
                $msg= "la contraseña ingresada es invalida. Debe tener al menos: 8 caracteres, 1 numero, 1 caracter especial ";
            }
            $msg= "la contraseña ingresada es invalida. Debe tener al menos: 8 caracteres, 1 numero, 1 caracter especial ";
            //$msg = $th->getMessage();
            //$msg = "el dni ingresado no es válido";

            /*if (strcmp($msg,"preg_match(): No ending delimiter '/' found" == 0)){
                $msg = "la contraseña ingresada es invalida. Debe tener al menos: 8 caracteres";
            }*/
        }        
        return view('chofer.crear', ['data' =>$msg])->with('request', $request);
        //return redirect()->route('chofer.index');      
    }
    public function actualizar(Chofer $chofer, Request $request)
    {       
        try {
            $msg = "la contraseña ingresada es invalida. Debe tener al menos: 8 caracteres, 1 numero, 1 caracter especial ";
            $rules = [
                'password' => [
                    'required',
                    'min:8',             // must be at least 10 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/', // must contain a special character
                ],
            ];
            $fields = [
                "password" => request('password')
            ];
            //echo $chofer->password.PHP_EOL;
            //echo request('password').PHP_EOL;
            $validator = Validator::make($fields,$rules);
            //echo $validator->fails();
           
                if(!$validator->fails()){
                    $msg = "el chofer se actualizó con exito";
                    $chofer->update([
                        'nombre'=>request('nombre'),
                        'apellido'=>request('apellido'),
                        'dni'=>request('dni'),
                        'email'=>request('email'),
                        'password'=>(request('password')),
                    ]);
                }

            
            if (request('email')== null){
                $msg = "Tiene que ingresar un email";
            }
            //echo $msg.PHP_EOL;
            
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
            
          /*  if(is_string(request('dni'))){
                $msg = "el dni ingresado es invalido";
            }*/
            
            if ($chofer->DNI != request('dni')){
                $msg = "el dni ingresado es invalido";
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
        }
                     
            //return redirect()->route('chofer.index');
        return view("chofer.actualizar", ["data"=>$msg,"chofer"=>$chofer])->with('request', $request);
    }
    public function eliminar(Chofer $chofer, Request $request)
    {
        $hoy=date('Y-m-d');
        $msg = "Se borró el chofer seleccionado con éxito";
        $viajes = Viaje::where('DNI','=',$chofer->DNI)->where('fecha','>', $hoy)->get();
        if ($viajes->count() == 0){
            $chofer->delete();
        }
        else{
            $msg = "No se puede eliminar el chofer seleccionado porque tiene viajes programados.";
        }
        $choferes = Chofer::all();
        return view('chofer.lista')->with(['choferes' =>$choferes])->with('msg',$msg)->with('request', $request);
    }
    
    public function perfil(Chofer $chofer, Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $viajes = Viaje::where('DNI','=',$chofer->DNI)->get();
        /*return view('chofer.perfil', ['viajes' =>$viajes,
        'chofer'=> $chofer]);*/
        return view('chofer.perfil')->with('chofer',$chofer)->with('viajes',$viajes)->with('request', $request);
       // return view('chofer.perfil',compact('chofer','viajes'));
    }

}