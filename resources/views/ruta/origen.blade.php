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
    @include('layouts.navAdmin') 
    <form method="" action="{{ route('selectDestino')}}">
        @csrf 
        <label for=""></label>
            <h3 class="d-inline m-2 p-2">Origen:</h3>
            <select name="combo">
                @foreach ($data as $item)
                    <option name="ruta" value="{{($item['nombre'])}}">{{$item['nombre']}}</option>
                @endforeach
            </select>
        </label>
        <div class="m-2 p-2">
            <button class="btn btn-primary">Siguiente</button>
            <button type="button" class="btn btn-outline-secondary"> <a href="{{route('ruta.index')}}">Atras</a></button>
        </div>
    </form>
    @endsection
</body>
</html>
@endif