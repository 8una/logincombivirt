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
    @section('content2')
        <h1>Gestion de combis</h1>
        <div>
            <button> <a href="{{route('crearCombi')}}"> Crear Combi  </a></button>
            <button> <a href="http://localhost/ProjectBar/logincombivirt/public/admin">Atras</a></button>
        </div>
        <div>
            <h3>Combis:</h3>
                <div class="container ">
                    <div class="row bg-primary">
                        <div class="col">Tipo:</div>
                        <div class="col">Capacidad:</div>
                        <div class="col">Patente:</div>
                        <div class="col">Acciones:</div>
                    </div>
                    @foreach ($data as $combi)
                    <div class="row d-flex">
                        <div class="col">{{$combi['tipo']}}</div>
                        <div class="col">{{$combi['cant asientos']}}</div>
                        <div class="col">{{$combi['patente']}}</div>
                        <div class="d-grid gap-2 d-md-block">
                            <form method="POST" action="{{ route('combi.borrar', $combi)}}">@csrf @method('DELETE')<button onclick="return ConfirmDelete() ">Eliminar ✖</button></form>
                        </div>
                        <div class="col">
                                <form method="POST" action="{{ route('combi.actualizar',$combi)}}">@csrf @method('PATCH')<button onclick="return ConfirmEdit() ">Editar 📋</button></form></div>
                        </div> 
                    </div>
                    @endforeach
                </div>
        </div>
        
    @endsection
    @endsection
</body>
</html>