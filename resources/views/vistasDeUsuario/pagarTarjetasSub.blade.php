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
        <table class="table table-striped ">
                <div class="container ">  
                    <thead class="bg-primary">
                       
                    </thead>                
            @foreach ($tarjetas as $tarjeta)
            <div>

            <form method="POST" action="{{route('pagarViajeConfirmado2',$viaje)}}">
            @csrf
            
            <label for="">Numero de tarjeta terminada en <br>
            <div>
                <input type="text" name="numero" value = "{{$tarjeta['nroTarjeta']}}" required minlength="2" maxlength="10" >
                <button type="submit" class="btn btn-outline-success">Pagar </button> </div>
            </div>
            </div>

        </form>

                    @endforeach
                </div>
                
        </table>  
        <tr>
                            <div class="col text-left"> <a href = "{{route('pagarViajeOtraTarjeta',$viaje)}}"class="btn btn-outline-success">Pagar con otra tarjeta </a> 
                            <button type="button" class="btn btn-outline-primary"><a href="{{route('compraViaje',$viaje)}}"> Atras </a></button></div>
                            
                            
                        </tr>
        <p>{{$data}}</p>

    @endsection
</body>
</html>