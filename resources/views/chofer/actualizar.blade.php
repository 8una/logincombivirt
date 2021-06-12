@extends('layouts.nav')
@extends('layouts.app')
@if (!Auth::user())
Usted no tiene permiso para visualizar esta página. 

@elseif($request->user()->authorizeRoles(['admin']))
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
    <h1> Edición del chofer {{$chofer->id}} </h1>
    <form  method="POST" action="{{route ('chofer.actualizado',$chofer)}}">
        @csrf @method('PATCH')
        <p>nombre: <input type="text" name="nombre" value = "{{$chofer->nombre}}"/></p>
        <p>apellido: <input type="text" name="apellido" value = "{{$chofer->apellido}}" /></p>
        <p>DNI: <input type="number" name="dni" value = "{{$chofer->DNI}}"/></p>
        <p>email: <input type="email" name="email" value = "{{$chofer->email}}"/></p>
        <p>password: <input type="password" name="password" value = "{{$chofer->password}}"/></p>
        <button class="bg-primary">Enviar</button>
        <button><a href="{{route('chofer.index')}}"> Atras </a></button> 
        @csrf
    </form>
    <p>{{$data}}</p>
    @endsection
    @endsection
</html>

@endif