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
        <div>Cargar un nuevo chofer</div>    
        <form method="POST" action="/choferCargado">
            @csrf
            <label for="">Nombre <br>
                <input type="text" name="nombre" required minlength="2" maxlength="10" >
            </label><br>
            <label for="">Apellido</label><br>
                <input type="text" name="apellido" /><br>
                {!! $errors->first('precio','<small>:message</small></br>')!!}
            </label><br>
            <label for="">DNI</label><br>
                <input number="text" name="dni" /><br>
                {!! $errors->first('stock','<small>:message</small></br>')!!}
            </label><br>
            <label for="">Email <br>
                <input type="email" name="email" required minlength="1" maxlength="20" >
            </label><br>
            <label for="">Password <br>
                <input type="text" name="password" required minlength="1" maxlength="10" >
            </label><br>
            <br>
            <button class="bg-primary">Enviar</button>
            <button><a href="/gestionDeChoferes"> Atras </a></button> 
        </form>
        <p>{{$data}}</p>
        
        

    @endsection
    @endsection
</body>
</html>

