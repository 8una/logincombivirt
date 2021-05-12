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
@section('content')
    @section('content2')
    <button> <a href="{{route('chofer.index')}}">Atras</a></button><br>
    
    <h1> Chofer #{{$chofer->id}} </h1>
    
    <p> Nombre: {{$chofer->nombre}} </p>
    <p> Apellido: {{$chofer->apellido}} </p>
    <p> Dni: {{$chofer->DNI}} </p>
    <p> Email: {{$chofer->email}} </p>
    <p> Password: {{$chofer->password}} </p>     
        <h3>Viajes:</h3>
            <table border="1">
            <tr>
                <td>ID Viaje</td>
                <td>Ruta:</td>
                <td>Precio:</td>
                <td>Fecha:</td>
                <td>Patente:</td>
            </tr>
            @foreach ($viajes as $viaje)
            
            <tr>
                <td>{{$viaje['id']}}</td>
                <td>{{$viaje['ruta']}}</td>
                <td>{{$viaje['precio']}}</td>
                <td>{{$viaje['fecha']}}</td>
                <td>{{$viaje['patente']}}</td>
            </tr>
            @endforeach
            </table>
        
    </div>
    
    
     </div> </p>    
          

@endsection
@endsection


