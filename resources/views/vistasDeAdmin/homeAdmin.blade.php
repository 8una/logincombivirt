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
        <h1 class="m-2 p-2">Combi 19</h1>
        
        <div class="border border-primary border-3 ">
            <form action="" class="m-2 p-2 ">
                <h3 class="m-2 p-2 ">Buscar un viaje</h3>
                <div class="d-flex ">
                <input type="text" class="form-control w-25 m-2" name="Ruta" id="" placeholder="ruta">
                <input type="date" class="form-control w-25 m-2" name="fecha-viaje" id="">
                <input type="number" class="form-control w-25 m-2" name="cantidad-pasajes" id="" placeholder="cant pasajes" min="1">
                <button class="rounded-pill btn btn-primary">Buscar</button>
            </div>
            </form>
        </div>
            <div class="bg-dark">
                <h3 class="text-light">Panel de administracion:</h3>
                <div class="container ">
                    <div class="row m-2 p-2 justify-content-center">
                        <div class="col-3 ">
                        <button type="button" class="btn btn-primary btn-lg w-100 h-100" ><a href="{{route("gestionDeViajes")}}" class="text-dark"> Administracion de Viajes</a></button>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-primary btn-lg w-100 h-100" ><a href="{{route("gestionDeCombis")}}" class="text-dark"> Administracion de Combis</a></button>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-primary btn-lg w-100 h-100"><a href="{{route("gestionDeCombis")}}" class="text-dark"> gestion De Cuentas</a></button>
                        </div>
                </div>
                <div class="row m-2 p-2 justify-content-center">
                    
                    <div class="col-3">
                        <button type="button" class="btn btn-primary btn-lg w-100 h-100" ><a href="{{route("item.index")}}"" class="text-dark"> gestion De Items</a></button>
                        </div>
                    
                    <div class="col-3">
                        <button type="button" class="btn btn-primary btn-lg w-100 h-100"><a href="{{route("chofer.index")}}"" class="text-dark"> gestion De Choferes</a></button>
                    </div>

                    <div class="col-3">
                        <button type="button" class="btn btn-primary btn-lg w-100 h-100" ><a href="{{route("ruta.index")}}"" class="text-dark">Rutas</a></button>
                    </div>
                </div>
        </div>
    @endsection
</body>
</html>