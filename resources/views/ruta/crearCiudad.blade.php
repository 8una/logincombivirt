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
    <form method="POST" action="{{ route('cargarNuevaCiudad')}} ">
        @csrf 
        <label for=""></label>
            <h3 class="d-inline m-2 p-2">Nombre:</h3>
                <input class="form-control w-25 m-3 p-2" name="ciudad"  type="text" placeholder="Ciudad:">
        </label>
        <div class="m-2 p-2">
            <button class="btn btn-primary">Agregar</button>
            <button type="button" class="btn btn-outline-secondary"> <a href="{{route('ruta.index')}}">Cancelar</a></button>
        </div>
        <br>
    </form>
    @endsection;
</body>
</html>