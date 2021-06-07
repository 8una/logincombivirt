@extends('layouts.app')
@if($request->user()->authorizeRoles(['admin']))
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
    <form method="POST" action="{{ route('cargarNuevaRuta')}} ">
        @csrf 
        <label for=""></label>
            <h3 class="d-inline m-2 p-2">Destino:</h3>
            <select name="combo">
                @foreach ($data as $item)
                    <option name="ruta" value="{{($item['nombre'])}}">{{$item['nombre']}}</option>
                @endforeach
            </select>
        </label>
        <div class="m-2 p-2">
            <button class="btn btn-primary">Finalizar</button>
            <button type="button" class="btn btn-outline-secondary"> <a href="{{route('ruta.index')}}">Cancelar</a></button>
        </div>
        <br>
        <hr>
        <label for=""></label>
                <h4 class="d-inline m-2 p-2">Origen:</h6></h4>
                <input class="form-control" name="origen" value="{{$origen}}" type="text" placeholder="{{$origen}}" aria-label="readonly input example" readonly>
            </label>
    </form>
    

    @endsection
</body>
</html>
@endif