@extends('layouts.app')
@if($request->user()->authorizeRoles(['admin']))
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
        var respuesta=confirm("¿Estas seguro que deseas eliminar el item seleccionado?");
        if (respuesta){
            return true;
        }
        return false;
    }

    function ConfirmEdit(){
        var respuesta=confirm("¿Estas seguro que deseas editar el item seleccionado?");
        if (respuesta){
            return true;
        }
        return false;
    }
</script>
<body>
@section('content')

    <h1 class="m-2">Items disponibles </h1>
        <div>
            <button class="btn btn-outline-primary ml-2"> <a href= "{{route('home')}}" >Atras</a></button>
        <h3 class="m-2">Items:</h3>
        <h3 class="m-2">Viaje : {{$viaje->id}}</h3>
        <h3 class="m-2">Viaje : {{$viaje->fecha}}</h3>

        <table class="table table-striped ">
                <div class="container ">  
                    <thead class="bg-primary">
                        <tr>
                            <th scope="col">Nombre:</th>
                            <th scope="col" class="text-center">Precio:</th>
                            <th scope="col">Acciones:</th>
                        </tr>
                    </thead>                
                    @foreach ($items as $item)
                    <tr>
                            <th><div class="col">{{$item['nombre']}}</th></div>
                            <th><div class="col text-center">{{$item['precio']}}</th></div>
                        <th>
                            <div class="d-flex">
                                <div class="pl-2"><form method="GET" action="{{ route('item.agregarCarro',$item,$viaje->id)}}"><button >Agregar al viaje 📋</button></form></div>
                            </div> 
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
    @endif