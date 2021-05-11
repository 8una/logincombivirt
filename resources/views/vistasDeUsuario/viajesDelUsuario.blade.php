@extends('layouts.nav')
@extends('layouts.app')



    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script>
    function ConfirmDelete(){
        var respuesta=confirm("¿Estas seguro que deseas cancelar el viaje?");
        if (respuesta){
            return true;
        }
        return false;
    }
</script>
<body>
    @section('content')
    @section('content2')
    <div>
        <h3 class="m-2">Mis viajes:</h3>
        <hr>
            <p class="m-2">{{$msg}}</p> 
        <hr>
        <table class="table table-striped ">
            <div class="container "">
                <thead class="bg-primary">
                    <tr >
                        <th scope="col">Ruta:</th>
                        <th scope="col">Fecha:</th>
                        <th scope="col" class="text-center">Hora:</th>
                        <th scope="col" class="text-center">Duracion:</th>
                        <th scope="col">Precio:</th>
                        <th scope="col">Acciones:</th>
                    </tr>
                </thead>
                @foreach ($data as $viaje)
                    <tr>   
                        <th><div class="col text-start"> {{$viaje->ruta}}</th></div>
                        <th><div class="col text-start"> {{$viaje->fecha}} </th></div>
                        <th><div class="col text-center"> {{$viaje->hora}} </th></div>
                        <th><div class="col text-center">{{$viaje->duracion}} </th></div>
                        <th><div class="col text-center">{{$viaje->precio}} $ARS</th></div>
                        
                        <th>
                            <div class="d-flex ">
                                <div class="pr-2"><form method="POST" action="{{-- {{ route('combi.borrar', $combi)}} --}}">@csrf @method('DELETE')<button class="btn btn-primary ml-2" onclick="return ConfirmDelete() ">Reprogramar 📋</button></form></div>
                                <div class="pl-2"><form method="POST" action="{{ route('cancelarViaje', [Auth::user()->DNI, $viaje->idViaje])}}">@csrf  @method('DELETE')<button  class="btn btn-outline-danger" onclick="return ConfirmDelete() ">Cancelar ✖</button></form></div>
                            </div>
                        </th> 
                    </tr>
                </div>
                @endforeach
        </table>
            </div>
    @endsection
@endsection
</body>
</html>