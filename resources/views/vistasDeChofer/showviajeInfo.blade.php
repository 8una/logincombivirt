@extends('layouts.app')
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
    <h1>Viaje en Curso</h1>
    <table class="table table-striped w-50">
        <div class="container "">
            <thead class="bg-primary">
                <tr >
                    <th scope="col" class="">Ruta:</th>
                    <th scope="col">Duracion:</th>
                </tr>
            </thead>
    @foreach ($viaje as $viaje)  
        <tr>
            <tr>   
                <th><div class="col">{{$viaje->ruta}}</th></div>
                <th><div class="col">{{$viaje->duracion}} Horas </th></div>
            </tr>
        </div>
        @endforeach
    </table>
    
    <h3>Pasajeros:</h3>
    <table class="table table-striped w-50">
        <div class="container "">
            <thead class="bg-primary">
                <tr >
                    <th scope="col" class="">DNI:</th>
                    <th scope="col">Estado:</th>
                </tr>
            </thead>
        @foreach ($viajeros as $viajeros)  
        <tr>
            <tr>   
                <th><div class="col">{{$viajeros->dniusuario}}</th></div>
                <th><div class="col">{{$viajeros->estado}} </th></div>
            </tr>
        </div>
        @endforeach
    </table>
    
        Usted tiene capacidad para {{$viaje['cant disponibles']}} personas
        <form method="POST" action="{{route('finalizarViaje',$viaje['id'])}}">@csrf<button>Finalizar Viaje</button></form>
    @endsection
</body>
</html>