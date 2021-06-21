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
    <h1> Agregar Nueva Tarjeta </h1>
    <hr>
    {{$msg}}
    <hr>
    <form method="POST" action="{{route('agregarTarjeta')}}" class="m-2 p-2">
        @csrf 
        <label for="">Nombre y apellido</label><br>
            <input type="text" name="nombreApellido" /><br>
        </label><br>
        <label for="">Numero de tarjeta <br>
            <input type="number" name="numero" required minlength="2"  maxlength="10">
        </label><br>
        <label for="">Fecha de vencimiento</label><br>
            <input type="text" name="fechaV" /><br>
        </label><br>
        <label for="">Codigo de seguridad</label><br>
            <input type="number" name="codigo" /><br>
        </label>
        <button class="btn btn-primary mt-2" type="submit">Guardar Tarjeta</button>
        <button type="button" class="btn btn-outline-primary mt-2"><a href="{{route('myprofile')}}"> Atras </a></button>

    </form>
    @endsection
    @endsection
</body>
</html>