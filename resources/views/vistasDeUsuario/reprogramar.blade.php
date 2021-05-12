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
        <hr>
          
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
                                <div class="pr-2"><form method="POST" action="{{ route('reprogramar', [Auth::user()->DNI, $viaje->ruta])}}"><button class="btn btn-primary ml-2">Reprogramar 📋</button></form></div>
                                
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