@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script type="text/javascript">
    function ConfirmDelete(){
        var respuesta=confirm("¿Estas seguro que deseas eliminar la ruta?");
        if (respuesta){
            return true;
        }
        return false;
    }
</script>

<body>
    @section('content')
        <h1 class="m-2">Administracion de Rutas</h1>
        <div class="d-flex">
            <button class="btn btn-outline-dark ml-2 h-75 mt-2 w-25"> <a href= "{{route('crearRuta')}}" >Cargar nueva Ruta</a></button>
            <button class="btn btn-outline-dark ml-2 h-75 mt-2"> <a href= "{{route('crearCiudad')}}" >Agregar Ciudad</a></button>
            <button class="btn btn-outline-dark ml-2 h-75 mt-2"> <a href= "{{route('quitarCiudad')}}" >Quitar Ciudad</a></button>
            
        </div>
        <div class="d-flex w-100">
            <form method = 'POST' action = "{{route('buscarRuta')}}" ><input class="btn btn-outline-dark ml-2 m-2 h-75 justify-content-right" type = "submite" name = "ruta" placeholder="Ruta a Buscar">@csrf</input></form>
            <form method = 'POST' action = "{{route('buscarRutaPorOrigen')}}"  ><input class="btn btn-outline-dark ml-2 m-2 h-75 justify-content-right" type = "submite" name = "origen" placeholder="Buscar Por Origen">@csrf</input></form>
            <form method = 'POST' action = "{{route('buscarRutaPorDestino')}}"><input class="btn btn-outline-dark ml-2 m-2 h-75 justify-content-right" type = "submite" name = "destino" placeholder="Buscar Por Destino">@csrf</input></form>
        </div>

        <div>
            <h3 class="m-2">Rutas:</h3>
            <hr>
                <p class="m-2">{{$mensaje}}</p>
            <hr>
            <table class="table table-striped ">
                <div class="container "">
                    <thead class="bg-primary">
                        <tr >
                            <th scope="col">Ruta:</th>
                            <th scope="col">Acciones:</th>
                        </tr>
                    </thead>
                    @foreach ($data as $ruta)
                        <tr>   
                            <th><div class="col">{{$ruta['nombreRuta']}}</th></div>
                            <th>
                                <div class="d-flex ">
                                    <div class="pr-2"><form method="POST" action="{{ route('ruta.borrar', $ruta)}}">@csrf @method('DELETE')<button class="btn btn-outline-danger" onclick="return ConfirmDelete()">Eliminar ✖</button></form></div>
                                </div>
                            </th> 
                        </tr>
                    </div>
                    @endforeach
            </table>
                </div>
                
        </div>
        
    @endsection
</body>
</html>