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
        <h3 class="m-2">Historial:</h3>
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
                        <th scope="col">Estado:</th>
                        <th scope="col">Acciones:</th>
                    </tr>
                </thead>
                @if(!$data->isEmpty())
                @foreach ($data as $viaje)
                    <tr>   
                        <th><div class="col text-start"> {{$viaje->ruta}}</th></div>
                        <th><div class="col text-start"> {{$viaje->fecha}} </th></div>
                        <th><div class="col text-center"> {{$viaje->hora}} </th></div>
                        <th><div class="col text-center">{{$viaje->duracion}} Hs </th></div>
                        <th><div class="col text-center">{{$viaje->precio}} $ARS</th></div>
                        <th><div class="col text-center">{{$viaje->estado}} </th></div>
                        <th>
                            @if ($viaje->estado=="sin calificar")
                                <div class="d-flex ">
                                    <div class="pr-2"><form method="" action="{{ route('calificarviaje', [$viaje->id])}}">@csrf<button class="btn btn-primary ml-2">Calificar ⭐</button></form></div>
                                </div>
                            @else
                                <div class="d-flex ">
                                    <div class="pr-2"> <p class="text-secondary">Sin acciones Pendientes</p> 
                                </div>
                            @endif

                        </th> 
                    </tr>
                </div>
                @endforeach
                @else
                    <div class="fw-bold text-secondary text-center">Usted no tiene viajes realizados   </div>
                @endif
        </table>
        
            </div>
    @endsection
@endsection
</body>
</html>