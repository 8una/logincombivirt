@extends('layouts.navAdmin')
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
        var respuesta=confirm("¿Estas seguro que deseas eliminar La combi?");
        if (respuesta){
            return true;
        }
        return false;
    }

    function ConfirmEdit(){
        var respuesta=confirm("¿Estas seguro que deseas cambiar el tipo de combi?");
        if (respuesta){
            return true;
        }
        return false;
    }
</script>




<body>
    @section('content')
    @section('contentAdmin')
        <h1 class="m-2">Gestion de combis</h1>
        <div>
        @csrf
            <button class="btn btn-outline-primary ml-2" > <a href="{{route('crearCombi')}}"> Crear Combi  </a></button>
            <button class="btn btn-outline-primary ml-2"> <a href= "{{route('homeAdmin')}}" >Atras</a></button>
            <form method = 'POST' action = "{{route('buscarCombi')}}" >
                <input class="btn btn-outline-primary ml-2" type = "submite" name = "patente">Patente a buscar</input>
                @csrf
            </form>
            @csrf
        </div>

        <div>
            <h3 class="m-2">Combis:</h3>
            <hr>
                <p class="m-2">{{$mensaje}}</p>
            <hr>
            <table class="table table-striped ">
                <div class="container "">
                    <thead class="bg-primary">
                        <tr >
                            <th scope="col">Tipo:</th>
                            <th scope="col" class="text-center">Capacidad:</th>
                            <th scope="col" class="text-center">Patente:</th>
                            <th scope="col">Acciones:</th>
                        </tr>
                    </thead>
                    @foreach ($data as $combi)
                        <tr>   
                            <th><div class="col">{{$combi['tipo']}}</th></div>
                            <th><div class="col text-center">{{$combi['cant asientos']}} </th></div>
                            <th><div class="col text-center">{{$combi['patente']}}  </th></div>
                            <th>
                                <div class="d-flex ">
                                    <div class="pr-2"><form method="POST" action="{{ route('combi.borrar', $combi)}}">@csrf @method('DELETE')<button class="btn btn-outline-danger" onclick="return ConfirmDelete() ">Eliminar ✖</button></form></div>
                                    <div class="pl-2"><form method="POST" action="{{ route('combi.actualizar',$combi)}}">@csrf @method('PATCH')<button  class="btn btn-primary ml-2" onclick="return ConfirmEdit() ">Editar 📋</button></form></div>
                                </div>
                            </th> 
                        </tr>
                    </div>
                    @endforeach
            </table>
                </div>
                
        </div>
        
    @endsection
    @endsection
</body>
</html>