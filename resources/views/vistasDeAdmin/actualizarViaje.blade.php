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
<body>
    @section('content')
    @include('layouts.navAdmin') 
    <h2>Datos Del Viaje:</h2>
    <hr>
    <h5 class="p-2 m-2"> Elegir la nueva fecha, hora y duracion</h3>
        <form method="" action="{{ route('selectCombiYChoferActualizar',$id )}}">
            @csrf 
        @foreach ($data as $viaje)
        

        <div class="d-flex ">
            <label for=""></label>
                <h4 class="d-inline m-2 p-2 ">Ruta:</h4>
                <input class="form-control w-25 d-inline" name="ruta" value="{{$viaje['ruta']}}" type="text"  placeholder="{{$viaje['ruta']}}" aria-label="readonly input example" readonly>
            </label>
        </div>

        <div class="d-flex">
            <label for=""></label>
                <h4 class="d-inline m-2 p-2">Fecha:</h4>
                <input class="form-control w-25 d-inline" name="fecha" value="{{$viaje['fecha']}}" type="date"  placeholder=" {{$viaje['fecha']}}" aria-label="readonly input example" min={{ now()->format('Y-m-d')}}>
            </label>
        </div>
        
        <div class="d-flex">
            <label for=""></label>
                <h4 class="d-inline m-2 p-2">Hora:</h4>
                <input class="form-control w-25 d-inline" name="hora" value="{{$viaje['hora']}}" type="time"  placeholder=" {{$viaje['hora']}}" aria-label="readonly input example" >
        </div>
        
        <div class="d-flex">
            <label for=""></label>
                <h4 class="d-inline m-2 p-2">Duracion:</h4>
                <input class="form-control w-25 d-inline" name="duracion" value="{{$viaje['duracion']}}" type="number"  placeholder="{{$viaje['duracion']}} " aria-label="readonly input example" >
            </label>
        </div>

        <div class="d-flex">
            <label for=""></label>
                <h4 class="d-inline m-2 p-2">Precio:</h4>
                <input class="form-control w-25 d-inline" name="precio" value="{{$viaje['precio']}}" type="number"  placeholder="{{$viaje['precio']}} " aria-label="readonly input example" >
            </label>
        </div>

        <div class="d-flex">
            <label for=""></label>
                <h4 class="d-inline m-2 p-2">Patente combi:</h4>
                <input class="form-control w-25 d-inline" name="patente" value="{{$viaje['patente']}}" type="number"  placeholder="{{$viaje['patente']}} " aria-label="readonly input example" readonly>
            </label>
        </div>
        
        <div class="d-flex">
            <label for=""></label>
                <h4 class="m-2 p-2">DNI chofer:</h4>
                <input class="form-control w-25" name="dni" value="{{$viaje['DNI']}}" type="text"  placeholder="{{$viaje['DNI']}}" aria-label="readonly input example" readonly>
            </label>
        </div>
        <div class="d-flex">
            <label for=""></label>
                <h4 class="d-inline m-2 p-2">Asientos:</h4>
                <input class="form-control w-25 d-inline" name="cantDisp" value="{{$viaje['cant disponibles']}}" type="text"  placeholder="{{$viaje['cant disponibles']}}" aria-label="readonly input example" readonly>
            </label>
    </div>
        @endforeach

        <div class="m-2 p-2">
        <button class="btn btn-primary">Siguiente</button>
                    <button type="button" class="btn btn-outline-secondary"> <a href="{{route('gestionDeViajes')}}">Atras</a></button>
        </div>
    </form>
    @endsection
</body>
</html>
@endif