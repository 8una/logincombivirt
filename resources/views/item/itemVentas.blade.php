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
@include('layouts.navAdmin') 
<button class="btn btn-outline-primary ml-2"> <a href= "{{route('home')}}" >Atras</a></button>
<h1 class="m-2">Viaje seleccionado:  </h1>
<table class="table table-striped ">
                    <div class="container "">
                        <thead class="bg-primary">
                            <tr >
                                <th scope ="col" class="col text-left"> Ruta: </th>
                                <th scope="col" class="col text-center"> Fecha: </th>
                                <th scope="col" class="col text-center"> Hora: </th>
                                <th scope="col" class="col text-left"> Precio: </th>
                                <th scope="col" class="col text-center"> Precio Total Viaje: </th>
                            </tr>
                        </thead>
                    <tr>   
                        <th><div class="col text-left">{{$viaje['ruta']}}</th></div>
                        <th><div class="col text-center">{{$viaje['fecha']}} </th></div>
                        <th><div class="col text-center">{{$viaje['hora']}}  </th></div>
                        <th><div class="col text-left">{{$viaje['precio'] }}  $ARS </th></div>
                        <th><div class="col text-center">{{$precioTotal }}  $ARS </th></div>
                    </tr>
                </div>
                </table> 
                <hr>
                {{$msg}}
            <hr>
   
    <h1 class="m-2">Items disponibles </h1>
        <div>
            

        <table class="table table-striped ">
                <div class="container ">  
                    <thead class="bg-primary">
                        <tr>
                            <th scope="col">Nombre:</th>
                            <th scope="col" class="text-center">Precio:</th>
                            <th scope="col" >cantidad agregada:</th>
                            <th scope="col">Acciones:</th>
                            
                        </tr>
                    </thead>                
                    @foreach ($items as $item)
                    <tr>
                            <th><div class="col">{{$item['nombre']}}</th></div>
                            <th><div class="col text-center">{{$item['precio']}}</th></div>
                            <th><div class="col">{{$item['cant']}}</th></div>
                        <th>
                            <div class="col text-left"> <a href = "{{ route('item.agregarCarro',[$item,$viaje,$precioTotal])}}"class="btn btn-outline-success">Agregar al viaje 🛒</a> </div>
                            @if ($item->cant > 0 )
                                <div class="col text-left ">
                                    <div class="pr-2"><form method="" action="{{ route('item.sacarCarro',[$item,$viaje,$precioTotal])}}">@csrf<button class="btn btn-outline-success">Sacar del viaje 🛒</button></form></div>
                                </div>
                            
                            @endif
                        </th>

                        
                        
                    </tr>
                    @endforeach
                </div>
                
        </table>  
        <th>
                <button class="btn btn-outline-primary ml-2"> <a href= "{{route('pagarViaje',$viaje)}}" >Pagar viaje</a></button>
                        </th>    
        </div>
        
    @endsection
