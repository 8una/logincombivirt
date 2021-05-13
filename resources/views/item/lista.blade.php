@extends('layouts.app')
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

    <h1 class="m-2">Gestion de items</h1>
        <div>
        <button class="btn btn-outline-primary ml-2" > <a href="{{route('item.crear')}}"> Crear Item </a></button>
            <button class="btn btn-outline-primary ml-2"> <a href= "{{route('homeAdmin')}}" >Atras</a></button>
        </div>
        
        <div>
        <h3 class="m-2">Items:</h3>
        <hr>
        {{$msg}}
            <hr>
        <table class="table table-striped ">
                <div class="container ">  
                    <thead class="bg-primary">
                        <tr>
                            <th scope="col">Nombre:</th>
                            <th scope="col" class="text-center">Precio:</th>
                            <th scope="col" class="text-center">Stock:</th>
                            <th scope="col">Acciones:</th>
                        </tr>
                    </thead>                
                    @foreach ($items as $item)
                    <tr>
                            <th><div class="col">{{$item['nombre']}}</th></div>
                            <th><div class="col text-center">{{$item['precio']}}</th></div>
                            <th><div class="col text-center">{{$item['stock']}}</th></div>
                        <th>
                            <div class="d-flex">
                                <div class="pr-2"><form method="POST" action="{{ route('item.borrar', $item) }}">@csrf @method('DELETE')<button onclick="return ConfirmDelete() ">Eliminar ✖</button></form></div>
                                <div class="pl-2"><form method="GET" action="{{ route('item.update',$item)}}"><button >Editar 📋</button></form></div>
                            </div> 
                        </th>
                    </tr>
                    @endforeach
                </div>
        </table>      
        </div>
        
    @endsection

