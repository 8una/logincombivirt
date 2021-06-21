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
    <h1>Proximo viaje a realizar</h1>
    <table class="table table-striped ">
        <div class="container "">
            <thead class="bg-primary">
                <tr >
                    <th scope="col">Ruta:</th>
                    <th scope="col" class="text-center"> Fecha:</th>
                    <th scope="col" class="text-center">Hora:</th>
                    <th scope="col"> Acciones:</th>
                </tr>
            </thead>
    @if (!$proximoViaje->isEmpty())
        @foreach ($proximoViaje as $viaje)  
        <tr>
            <tr>   
                <th><div class="col text-left">{{$viaje->ruta}}</th></div>
                <th><div class="col text-center">{{$viaje->fecha}} </th></div>
                <th><div class="col text-center">{{$viaje->hora}}  </th></div>
                <th>
                <div class="d-flex">
                    <div><button> CAncelar   </button></div>
                    <div> <button> Iniciar </button> </div>    
                </div> 
                </th>
            </tr>
        </div>
        @endforeach
    @endif
    </table>


    <h3>Pasajeros anotados:</h3>
    <table class="table table-striped w-50 ">
        <div class="container "">
            <thead class="bg-primary">
                <tr >

                    <th scope="col" class="text-center">DNI:</th>
                    <th scope="col"   class="text-center "> Acciones:</th>
                </tr>
            </thead>
    @if (!$viajeros->isEmpty())
        @foreach ($viajeros as $data)  
        <tr>
            <tr>   
                <th><div class="col text-center">{{$data->dniusuario}}  </th></div>
                <th> 
                    <div class="d-flex ml-5 mr-5 pl-5 "> 
                    <div><button>Aceptar pasajero </button></div>
                    <div><button> Aceptar pasajero </button></div>
                    <div><button> Aceptar pasajero </button></div>
                    </div>
                </th>
            </tr>
        </div>
        @endforeach
    @endif
    </table>
    @endsection
</body>
</html>