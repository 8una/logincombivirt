@extends('layout')
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
        
    
    <br>
    <form method="POST" action="{{ route('viaje.SeleccionDeChofer')}}">
        @csrf @method("PATCH")
        <label for=""></label>
            Patente de combi:
            <select name="combo">
                @foreach ($data as $item)
                    <option value="{{$item['patente']}}">{{$item['patente']}}</option>
                @endforeach
            </select>
        </label>
        <br>
        <button>Siguiente</button>
        <button><a href="/gestionDeViajes">Cancelar</a></button>
    </form>
    @endsection
</body>
</html>
@endif