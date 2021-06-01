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
        <div><h1> Pago de viaje </h1></div>   
        <form method="POST" action="{{route('pagarViajeConfirmado',$viaje)}}">
            @csrf
            <label for="">Numero de tarjeta <br>
                <input type="number" name="numero" required minlength="2" maxlength="10" >
            </label><br>
            <label for="">Fecha de vencimiento</label><br>
                <input type="text" name="fechaV" /><br>
            </label><br>
            <label for="">Codigo de seguridad</label><br>
                <input type="number" name="codigo" /><br>
            </label>
            <button class="btn btn-primary ml-2" type="submit">Confirmar Pago</button>
            <button type="button" class="btn btn-outline-primary"><a href="{{route('compraItems',$viaje)}}"> Atras </a></button>

        </form>
        <p>{{$data}}</p>
        
    @endsection
</body>
</html>

