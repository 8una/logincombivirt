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
    @section('content2')
    <h1>Gestion de items</h1>
        <div>
            <button> <a href="{{route('item.crear')}}"> Crear Item  </a></button>
            <button> <a href="/admin">Atras</a></button>
        </div>
        <div>
            <h3>Items:</h3>
                <div class="container ">
                    <div class="row bg-primary">
                        <div class="col">Nombre:</div>
                        <div class="col">Precio:</div>
                        <div class="col">Stock:</div>
                    </div>
                    @foreach ($items as $item)
                    <div class="row d-flex">
                        <div class="col">{{$item['nombre']}}</div>
                        <div class="col">{{$item['precio']}}</div>
                        <div class="col">{{$item['stock']}}</div>
                        <div class="d-grid gap-2 d-md-block">
                            <form method="POST" action="{{ route('item.borrar', $item)}}">@csrf @method('DELETE')<button onclick="return ConfirmDelete() ">Eliminar ✖</button></form>
                        </div>
                        <div class="col">
                                <form method="GET" action="{{ route('item.update',$item)}}"><button onclick="return ConfirmEdit() ">Editar 📋</button></form></div>
                        </div> 
                    </div>
                    @endforeach
                </div>
        </div>
        
    @endsection
    @endsection




@section("pie")
