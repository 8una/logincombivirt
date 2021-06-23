<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Chofer;
use App\Models\Viaje;
use App\Models\Marcados;
use App\Combi;
use App\Usuarioviaje;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChoferController extends Controller
{

    //home del chofer esto se ejecutaria cuando se loguea como chofer
    public function showhome()
    {
        $estado = 'rascandose';
        return view('vistasDeChofer/homeChofer')->with('estado', $estado);
    }

    //ver mi proximo viaje cvhofer
    public function showProximoViaje($chofer)
    {
        //HAY QUE HACER QUE CUANDO SE CREA UN CHOFER SE AGREGA A LA TABLA DE USERS
        $hoy=date('Y-m-d H:i:s');
        $hoy = strtotime ( '-3 hour' , strtotime ($hoy)); 
        $hoy = date ( 'Y-m-d H:i:s' , $hoy); 
        $dnichofer= Chofer::where('DNI', Auth::user()->dni)->select('DNI')->value('DNI');
        $proximoViaje= Viaje::where('DNI', $dnichofer)->where('inicio','>=',$hoy)->orderBy('inicio', 'ASC')->take(1)->get();
        $proximoViajeID= Viaje::where('DNI', $dnichofer)->where('inicio','>=',$hoy)->orderBy('inicio', 'ASC')->take(1)->value('id');
        $inicioViaje =Viaje::where('DNI', $dnichofer)->where('inicio','>=',$hoy)->orderBy('inicio', 'ASC')->take(1)->value('inicio');
      
        $hoy = strtotime ( '+1 hour' , strtotime ($hoy) ) ; 
        $hoy = date( 'Y-m-d H:i:s' , $hoy); 
        if ($hoy > $inicioViaje){
            $estado= 'arribando';
        }
        else{
            $estado= 'inactivo';
        }
        //agregar el ->where('estado', '<>' 'cancelado')
        $viajeros=Usuarioviaje::where('idViaje', $proximoViajeID)->get();
        return view('vistasDeChofer/proximoViajeChofer')->with('viajeros',$viajeros)->with('proximoViaje',$proximoViaje)->with('estado',$estado);
    }

    public function rechazarPasajero($dni)
    {
        $marcados= Marcados::where('DNI', $dni)->get()->count();
        $hoy=date('Y-m-d H:i:s');
        $hoy = strtotime ( '-3 hour' , strtotime ($hoy)); 
        $hoy = date ( 'Y-m-d H:i:s' , $hoy);
        $fechaFin= strtotime ( '+14 days' , strtotime ($hoy)); 
        $fechaFin = date( 'Y-m-d H:i:s' , $fechaFin); 
        if ($marcados > 0){
            Marcados::where('DNI', $dni)->update([
                'fechaInicio' => $hoy,
                'fechaFin' => $fechaFin 
            ]);
        }
        else{
            Marcados::create([
                'DNI' => $dni,
                'fechaInicio' => $hoy,
                'fechaFin' => $fechaFin 
            ]);
        }

        //LINEAS DE CODIGO
        $dnichofer= Chofer::where('DNI', Auth::user()->dni)->select('DNI')->value('DNI');
        $proximoViaje= Viaje::where('DNI', $dnichofer)->where('inicio','>=',$hoy)->orderBy('inicio', 'ASC')->take(1)->get();
        $proximoViajeID= Viaje::where('DNI', $dnichofer)->where('inicio','>=',$hoy)->orderBy('inicio', 'ASC')->take(1)->value('id');
        $inicioViaje =Viaje::where('DNI', $dnichofer)->where('inicio','>=',$hoy)->orderBy('inicio', 'ASC')->take(1)->value('inicio');
        //sacar al usuario del viaje y cambiar el estado de usuario viajes
        Usuarioviaje::where('dniusuario', $dni)->where('idViaje', $proximoViajeID)->update([
            'estado' => 'cancelado'
        ]);
        $capacidadActualizada =Viaje::where('id',$proximoViajeID )->value('cant disponibles');
        $capacidadActualizada = intval($capacidadActualizada);
        $capacidadActualizada = $capacidadActualizada + 1;

        Viaje::where('id',$proximoViajeID )->update([
            'cant disponibles' => $capacidadActualizada
        ]);
        $chofer= Auth::user()->dni ;
        return redirect('showProximoViaje/{$chofer}');
    }

    //CARGAR DECLARACION JURADA
    public function cargarDeclaracionJurada($viajero)
    {
        $viajante=User::where('dni', $viajero)->get();
        return view('vistasDeChofer/formularioDeDeclaracionJurada')->with('viajante',$viajante);
    }

    public function cargoDeclaracionJurada()
    {
        $hoy=date('Y-m-d H:i:s');
        $hoy = strtotime ( '-3 hour' , strtotime ($hoy)); 
        $hoy = date ( 'Y-m-d H:i:s' , $hoy);
        $dnichofer= Chofer::where('DNI', Auth::user()->dni)->select('DNI')->value('DNI');
        $proximoViaje= Viaje::where('DNI', $dnichofer)->where('inicio','>=',$hoy)->orderBy('inicio', 'ASC')->take(1)->get();
        $proximoViajeID= Viaje::where('DNI', $dnichofer)->where('inicio','>=',$hoy)->orderBy('inicio', 'ASC')->take(1)->value('id');
        $dni = request('DNI');
        $sintomas= request('sintomas');
        if ($sintomas == null){
            $sintomas = 0;
        }
        else{
            $sintomas =count($sintomas);
        }
        if ($sintomas >= 3){
            $msg = "Usted no puede viajar, se le cancelo su viaje y por 14 dias no podra viajar";
            $marcados= Marcados::where('DNI', $dni)->get()->count();
            $hoy=date('Y-m-d H:i:s');
            $hoy = strtotime ( '-3 hour' , strtotime ($hoy)); 
            $hoy = date ( 'Y-m-d H:i:s' , $hoy);
            $fechaFin= strtotime ( '+14 days' , strtotime ($hoy)); 
            $fechaFin = date( 'Y-m-d H:i:s' , $fechaFin); 
            if ($marcados > 0){
                Marcados::where('DNI', $dni)->update([
                    'fechaInicio' => $hoy,
                    'fechaFin' => $fechaFin 
                ]);
            }
            else{
                Marcados::create([
                    'DNI' => $dni,
                    'fechaInicio' => $hoy,
                    'fechaFin' => $fechaFin 
                ]);
            }

            //LINEAS DE CODIGO
            $dnichofer= Chofer::where('DNI', Auth::user()->dni)->select('DNI')->value('DNI');
            $proximoViaje= Viaje::where('DNI', $dnichofer)->where('inicio','>=',$hoy)->orderBy('inicio', 'ASC')->take(1)->get();
            $proximoViajeID= Viaje::where('DNI', $dnichofer)->where('inicio','>=',$hoy)->orderBy('inicio', 'ASC')->take(1)->value('id');
            $inicioViaje =Viaje::where('DNI', $dnichofer)->where('inicio','>=',$hoy)->orderBy('inicio', 'ASC')->take(1)->value('inicio');
            //sacar al usuario del viaje y cambiar el estado de usuario viajes
            Usuarioviaje::where('dniusuario', $dni)->where('idViaje', $proximoViajeID)->update([
                'estado' => 'cancelado'
            ]);
            $capacidadActualizada =Viaje::where('id',$proximoViajeID )->value('cant disponibles');
            $capacidadActualizada = intval($capacidadActualizada);
            $capacidadActualizada = $capacidadActualizada + 1;

            Viaje::where('id',$proximoViajeID )->update([
                'cant disponibles' => $capacidadActualizada
            ]);
            $chofer= Auth::user()->dni ;
            return redirect('showProximoViaje/{$chofer}');
                /* return redirect ('rechazarPasajero/{$dni}'); */
        }
        else{
            $msg ="Pasajero Aceptado, Buen viaje";
            Usuarioviaje::where('dniusuario', $dni)->where('idViaje', $proximoViajeID)->update([
                'estado' => 'en viaje'
            ]);
            return redirect('showProximoViaje/{$chofer}');
        }
    }

    public function index(Request $request)
    {
        $msg = "";
        $choferes = Chofer::get();
        return view('chofer.lista')->with(['choferes' =>$choferes])->with('msg',$msg)->with('request',$request);
    }
    public function crearForm(Request $request)
    {
        $data = '';
        return view('chofer.crear', ['data' =>$data])->with('request',$request);
    }
    public function actualizarForm(Chofer $chofer, Request $request)
    {

        //return view("chofer.actualizar", compact("chofer"));
        $data = '';
        return view('chofer.actualizar')->with('chofer',$chofer)->with('data',$data)->with('request',$request);
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
        }        
        return view('chofer.crear', ['data' =>$msg]);
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

            $choferes = Chofer::get();
            return view('chofer.lista')->with(['choferes' =>$choferes])->with('msg',$msg)->with('request',$request);
            //return view("chofer.actualizar", ["data"=>$msg,"chofer"=>$chofer]);
            //echo $msg.PHP_EOL;
            
            //return redirect()->route('chofer.index');
        } catch (\Illuminate\Database\QueryException $th) {

            if ($chofer->DNI != request('dni')){
                $msg = "el dni ingresado es invalido";
                $cantChoferes = Chofer::where("dni", "=", request('dni'))->count();
                if ($cantChoferes == 1){
                    $msg = "el dni ingresado ya se encuentra registrado en el sistema";
                    return view("chofer.actualizar", ["data"=>$msg,"chofer"=>$chofer]);
                }                
            }
            else{
                if (strcmp($chofer->email,request('email')) == 0){
                    $cantChoferes2 = Chofer::where("email", "=", request('email'))->count();
                    if ($cantChoferes2 == 1){
                        $msg = "el email ingresado ya se encuentra registrado en el sistema";
                        return view("chofer.actualizar", ["data"=>$msg,"chofer"=>$chofer])->with('request',$request);
                    }
        
                }
                
            } 
        }
                     
            //return redirect()->route('chofer.index');
        
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
        return view('chofer.lista')->with(['choferes' =>$choferes])->with('msg',$msg)->with('request',$request);
    }
    
    public function perfil(Chofer $chofer, Request $request)
    {
        $viajes = Viaje::where('DNI','=',$chofer->DNI)->get();
        /*return view('chofer.perfil', ['viajes' =>$viajes,
        'chofer'=> $chofer]);*/
        return view('chofer.perfil')->with('chofer',$chofer)->with('viajes',$viajes)->with('request',$request);
       // return view('chofer.perfil',compact('chofer','viajes'));
    }

    public function iniciarViaje($viaje)
    {
        Viaje::where('id', $viaje)->update([
            'estado' => 'en viaje'
        ]);
        $estado='viajando';
        return view('vistasDeChofer/homeChofer')->with('estado', $estado);
    }

    public function showviajeInfo($chofer)
    {
        $idViaje= Viaje::where('DNI', $chofer)->where('estado', 'en viaje')->value('id');
        $viaje= Viaje::where('DNI', $chofer)->where('estado', 'en viaje')->get();

        $viajeros= Usuarioviaje::where('idViaje', $idViaje)->where('estado', '<>', 'cancelado')->get();        
        
        return view('vistasDeChofer/showviajeInfo')->with('viajeros',$viajeros)->with('viaje',$viaje);
        //devolver la informacion del viaje QUE TENGA UN BOTON PSARA FINALIZAR EL MISMO
    }

    public function finalizarViaje($viaje)
    {
        Viaje::where('id', $viaje)->update([
            'estado' => 'finalizado'
        ]);

        Usuarioviaje::where('idViaje', $viaje)->where('estado', '<>', 'cancelado')->update([
            'estado' => 'sin calificar'
        ]);

        $estado='rascandose';
        return view('vistasDeChofer/homeChofer')->with('estado', $estado);
    }
}