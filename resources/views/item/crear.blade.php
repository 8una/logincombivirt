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
        <div>Cargar un nuevo item</div>    
        <form method="POST" action="/itemCargado">
            @csrf
            <label for="">Nombre <br>
                <input type="text" name="nombre" required minlength="1" maxlength="10" >
            </label><br>
            <label for="">Precio</label><br>
                <input type="text" name="precio" value = "0"/><br>
                {!! $errors->first('precio','<small>:message</small></br>')!!}
            </label><br>
            <label for="">Stock</label><br>
                <input type="number" name="stock" value = "0"/><br>
                {!! $errors->first('stock','<small>:message</small></br>')!!}
            </label><br>
            <br>
            <button class="bg-primary">Enviar</button>
            <button><a href="/gestionDeItems"> Atras </a></button> 
        </form>
        <p>{{$data}}</p>
        
        
   
    @endsection
    @endsection
</body>
</html>