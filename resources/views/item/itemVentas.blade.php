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
<div class="d-flex bg-dark text-light justify-content-end">
    <h1 class="m-2 ">Viaje seleccionado:  </h1>
    <button class="btn btn-primary ml-2 pr-4 "> <a href= "{{route('home')}}" style="color:black">Atras</a></button>
</div>
<table class="table table-striped ">
                    <div class="container "">
                        <thead class="bg-primary">
                            <tr >
                                <th scope ="col" class="col-2 "> Ruta: </th>
                                <th scope="col" class="col-2 "> Fecha: </th>
                                <th scope="col" class="col-2 "> Hora: </th>
                                <th scope="col" class="col-2 "> Precio: </th>
                                <th scope="col" class="col-2 "> Precio Total Viaje: </th>
                            </tr>
                        </thead>
                    <tr>   
                        <th><div class="col">{{$viaje['ruta']}}</th></div>
                        <th><div class="col ">{{$viaje['fecha']}} </th></div>
                        <th><div class="col ">{{$viaje['hora']}}  </th></div>
                        <th><div class="col ">{{$viaje['precio'] }}  $ARS </th></div>
                        <th><div class="col ">{{$precioTotal }}  $ARS </th></div>
                    </tr>
                </div>
                </table> 
                <hr>
                {{$msg}}
            <hr>
   
    <h3 class="m-2">Items disponibles </h3>
        <div>
            

        <table class="table table-striped ">
                <div class="container ">  
                    <thead class="bg-dark text-light">
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
                            <div class="d-flex">
                                <div class=""> <a href = "{{ route('item.agregarCarro',[$item,$viaje,$precioTotal])}}"class="btn btn-outline-success">+ 🛒</a> </div>
                                @if ($item->cant > 0 )
                                    <div class="">
                                        <div class="pr-2"><form method="" action="{{ route('item.sacarCarro',[$item,$viaje,$precioTotal])}}">@csrf<button class="btn btn-outline-success">- 🛒</button></form></div>
                                    </div>
                                @endif
                            </div>
                        </th>

                        
                        
                    </tr>
                    @endforeach
                </div>
                
        </table>  
        <th>
                <button class="btn btn-lg btn-outline-success ml-2"> <a style="text-decoration:none" href= "{{route('pagarViaje',$viaje)}}" >Pagar viaje👉🤑👈</a></button>
                        </th>    
        </div>
        
    @endsection
