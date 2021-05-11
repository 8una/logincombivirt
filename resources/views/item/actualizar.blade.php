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
    <h1> Edición del item {{$item->id}} </h1>
    <form  method="POST" action="{{route ('item.actualizado',$item)}}">
        @csrf @method('PATCH')
        <p>nombre: <input type="text" name="nombre" value = "{{$item->nombre}}"/></p>
        <p>precio: <input type="text" name="precio" value = "{{$item->precio}}" /></p>
        <p>stock: <input type="text" name="stock" value = "{{$item->stock}}"/></p>
        <button class="bg-primary">Enviar</button>
        <button><a href="/gestionDeItems"> Atras </a></button> 
        @csrf
    </form>
    <p>{{$data}}</p>

    @endsection
    @endsection
</html>