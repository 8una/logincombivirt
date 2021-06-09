@extends('layouts.app')
@if (!Auth::user())
Usted no tiene permiso para visualizar esta página. 

@elseif($request->user()->authorizeRoles(['admin']))
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script type="text/javascript">
    function ConfirmDelete(){
        var respuesta=confirm("¿Estas seguro que deseas eliminar El viaje?");
        if (respuesta){
            return true;
        }
        return false;
    }
</script>
<body>
    
    @section('content')
    @include('layouts.navAdmin')  
    
    <h1>Administracion de viajes</h1>
    <div class="bg-dark">
    
        <button class="btn btn-dark btn-lg"><a href="{{route("crearViaje")}}" class="text-light"> Cargar Viajes</a></button>
        <button class="btn btn-dark btn-lg"> <a href="#" class="text-light"> Historial de viajes</a></button>
       
    </div>
   
    <hr>
        {{$msg}}
    <hr>
    <div>
        <h3>Viajes a realizar:</h3>
            <table class="table table-striped ">
                <thead class="bg-primary">
                    <tr >
                        <th scope="col">Ruta:</th>
                        <th scope="col" class="text-center">Fecha:</th>
                        <th scope="col" class="text-center">Hora:</th>
                        <th scope="col" class="text-center">Patente:</th>
                        <th scope="col">DNI chofer:</th>
                        <th scope="col">Precio:</th>
                        <th scope="col">Cant disponibles:</th>
                        <th scope="col">Acciones:</th>
                    </tr>
                </thead>
            @foreach ($data as $viaje)
                <tr>   
                    <th><div class="col">{{$viaje['ruta']}}</th></div>
                    <th><div class="col text-center">{{$viaje['fecha']}}  </th></div>
                    <th><div class="col text-center">{{$viaje['hora']}}  </th></div>
                    <th><div class="col text-center">{{$viaje['patente']}}  </th></div>
                    <th><div class="col text-center">{{$viaje['DNI']}}  </th></div>
                    <th><div class="col text-center">{{$viaje['precio']}} $ARS </th></div>
                    <th><div class="col text-center">{{$viaje['cant disponibles']}}  </th></div>
                    <th>
                        <div class="d-flex ">

                            
                            <div class="pr-2"><form method="POST"  action="{{ route('viaje.borrar', [$viaje, $viaje->patente])}}">@csrf @method('DELETE')<button class="btn btn-outline-danger" onclick="return ConfirmDelete() ">Eliminar ✖</button></form></div>
                            <div class="pl-2"><form method="" action="{{route('viaje.actualizar', $viaje)}}">@csrf <button  class="btn btn-primary ml-2">Editar 📋</button></form></div>
                        </div>
                    </th> 
                </tr>
            @endforeach
            </table>
        
    </div>

    @endsection
</body>
</html>
@endif