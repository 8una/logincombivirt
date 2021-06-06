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
        <div>Cargar un nuevo item</div>    
        <form method="POST" action="{{route('item.cargado')}}">
            @csrf
            <label for="">Nombre <br>
                <input type="text" name="nombre" required minlength="1" maxlength="10" >
            </label><br>
            <label for="">Precio</label><br>
                <input type="number" name="precio" value = "0"/><br>
                {!! $errors->first('precio','<small>:message</small></br>')!!}
            </label><br>

            <br>
            <button class="btn btn-primary ml-2" type="submit">Enviar</button>
            <button type="button" class="btn btn-outline-primary"><a href="{{route('item.index')}}"> Atras </a></button>
        </form>
        
        <p>{{$data}}</p>
        
   
    @endsection
</body>
</html>