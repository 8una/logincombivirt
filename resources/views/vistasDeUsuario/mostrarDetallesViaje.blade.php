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
<body>
    @section('content')
    @section('content2')
    <div>
        <h3 class="m-2">Mis viajes:</h3>
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
                @foreach ($viaje as $viaje)
                    <tr>   
                        <th><div class="col text-start"> {{$viaje->ruta}}</th></div>
                        <th><div class="col text-start"> {{date('d-M-y', strtotime($viaje->fecha))}} </th></div>
                        <th><div class="col text-center"> {{date('g:ia', strtotime($viaje->hora))}}</th></div>
                        <th><div class="col text-center">{{$viaje->duracion}} </th></div>
                        <th><div class="col text-center">{{$viaje->precio}} $ARS</th></div>
                        <th><div class="col text-center"> {{$viaje->estado}}</th></div>
                    </tr>
                </div>
                @endforeach
        </table>
            </div>
        <hr>
        <h3 class="m-2 p-2">Items comprados:</h3>
        <table class="table table-striped w-25">
            <div class="container "">
                <thead class="bg-primary">
                    <tr >
                        <th scope="col">Nombre:</th>
                        <th scope="col">Precio:</th>
                    </tr>
                </thead>
                @foreach ($items as $items)
                    <tr>   
                        <th><div class="col "> {{$items->nombreItem}}</th></div>
                        <th><div class="col ">{{$items->precioItem}} $ARS</th></div>
                    </tr>
                </div>
                @endforeach
        </table>
            </div>
        <hr>
    @endsection
    @endsection
</body>
</html>