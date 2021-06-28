@extends('layouts.app')
@guest
           Usted no tiene permiso para ver esta página.
            @else
            @if(Auth::user()->isAdmin())
            Usted no tiene permiso para ver esta página.
            @endif
            @if(Auth::user()->isUser())
            Usted no tiene permiso para ver esta página.
            @endif  
            @if(Auth::user()->isChofer())
            
            
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
    <div >
        @if ($estado == 'rascandose')
            <form action="{{ route('showProximoViaje',Auth::user()->dni)}}">@csrf<button class="w-100 bg-dark text-light" style="height: 3em; font-size: 10em;">Proximo viaje</button></form>
        @else
            <form action="{{ route('showviajeInfo',Auth::user()->dni)}}">@csrf<button class="w-100 bg-dark text-light" style="height: 3em; font-size: 5em;">Viaje Info</button></form>
            <form action="{{ route('cargarPasajeroExistente',Auth::user()->dni)}}">@csrf<button class="w-100 bg-dark text-light" style="height: 3em; font-size: 5em;">Cargar Pasajero Existente</button></form> 
            <form action="{{ route('cargarPasajeroInexistente',Auth::user()->dni)}}">@csrf<button class="w-100 bg-dark text-light" style="height: 3em; font-size: 5em;">Cargar Pasajero Inexistente</button></form> 
        @endif
    </div>


@endsection
</body>
</html>
@endif  
            @endguest
