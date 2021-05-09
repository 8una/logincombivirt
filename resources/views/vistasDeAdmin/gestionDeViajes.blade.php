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
        
    
    <h1> Bienvenido a la Administracion de viajes</h1>
    <hr>
    <h4>Esto es lo que puede hacer:</h4>
    <div>
        <p>Buscar un viaje:</p>
        <div class="buscador-viaje">
            <form action="">
                <input type="text" name="ciudad-origen" id="" placeholder="origen">
                <input type="text" name="ciudad-destino" id="" placeholder="destino">
                <input type="date" name="fecha-viaje" id="">
                <input type="number" name="cantidad-pasajes" id="" placeholder="cant pasajes" min="1">
                <button class="boton-buscar">Buscar</button>
            </form>
        </div>

    </div>
    <br><br><br>
    <div class="bg-primary">
        <h4>Manipulacion De Viajes:</h4>
        <button> <a href="/crearViaje"> Cargar Viajes</a></button>
        <button> <a href="#"> Eliminar Viajes</a></button>
        <button> <a href="#"> Actualizar Viajes</a></button>
        <button> <a href="http://localhost/ProjectBar/logincombivirt/public/admin">Atras</a></button>
    </div>

        <br>
        <br>
    <div>
        <h3>Viajes:</h3>
            <table border="1">
            <tr>
                <td>Ruta:</td>
                <td>Precio:</td>
                <td>Fecha:</td>
                <td>Patente:</td>
                <td>DNI chofer:</td>
            </tr>
            @foreach ($data as $viaje)
            
            <tr>
                <td>{{$viaje['ruta']}}</td>
                <td>{{$viaje['precio']}}</td>
                <td>{{$viaje['fecha']}}</td>
                <td>{{$viaje['patente']}}</td>
                <td>{{$viaje['DNI']}}</td>
            </tr>
            @endforeach
            </table>
        
    </div>

    @endsection
    @endsection
</body>
</html>