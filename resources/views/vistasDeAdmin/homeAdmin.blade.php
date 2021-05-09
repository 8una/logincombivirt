@extends('layouts.nav')
@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    
</head>
<body>
    @section('content')
    @section('content2')
        <h1>Combi 19</h1>
        <h3>Buscar un viaje</h3>
        <div class="buscador-viaje">
            <form action="">
                <input type="text" name="ciudad-origen" id="" placeholder="origen">
                <input type="text" name="ciudad-destino" id="" placeholder="destino">
                <input type="date" name="fecha-viaje" id="">
                <input type="number" name="cantidad-pasajes" id="" placeholder="cant pasajes" min="1">
                <button class="boton-buscar">Buscar</button>
            </form>
        </div>
            <div class="bg-primary">
                <h4>Panel de administracion</h4>
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                        <button type="button" class="btn btn-dark btn-lg" ><a href="{{route("gestionDeViajes")}}" > Administracion de Viajes</a></button>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-dark btn-lg"><a href="{{route("gestionDeCombis")}}"> Administracion de Combis</a></button>
                        </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <button type="button" class="btn btn-dark btn-lg"><a href="/gestionDeCuentas"> gestion De Cuentas</a></button>
                        </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-dark btn-lg"><a href="/gestionDeItems"> gestion De Items</a></button>
                        </div>
                </div>
            </div>
        </div>
    @endsection
    @endsection
</body>
</html>