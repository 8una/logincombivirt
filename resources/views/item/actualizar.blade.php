@extends('layouts.navAdmin')
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
@section('contentAdmin')
    <h1> Edición del item {{$item->id}} </h1>
    <form  method="POST" action="{{route ('item.actualizado',$item)}}">
        @csrf @method('PATCH')
        <p>nombre: <input type="text" name="nombre" value = "{{$item->nombre}}"/></p>
        <p>precio: <input type="number" name="precio" value = "{{$item->precio}}" /></p>
        {!! $errors->first('precio','<small>:message</small></br>')!!}
        <p>stock: <input type="number" name="stock" value = "{{$item->stock}}"/></p>
        {!! $errors->first('stock','<small>:message</small></br>')!!}
        <button class="btn btn-outline-primary ml-2"> Confirmar  </a></button>
        <button class="btn btn-outline-primary ml-2"> <a href= "{{route('item.index')}}" >Atras</a></button>
        @csrf
    </form>
    <p>{{$data}}</p>

    @endsection
    @endsection
</html>