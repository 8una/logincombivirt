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
        var respuesta=confirm("¿Estas seguro que deseas eliminar el chofer?");
        if (respuesta){
            return true;
        }
        return false;
    }

    function ConfirmEdit(){
        var respuesta=confirm("¿Estas seguro que deseas editar el chofer?");
        if (respuesta){
            return true;
        }
        return false;
    }
</script>
<body>
@section('content')
    @section('content2')
    <h1>Gestion de choferes</h1>
        <div>
            <button> <a href="/createChofer"> Crear Chofer  </a></button>
            <button> <a href="/admin">Atras</a></button>
        </div>
        <div>
            <h3>Choferes:</h3>
                <div class="container ">
                    <div class="row bg-primary">
                        <div class="col">Apellido:</div>
                        <div class="col">Dni:</div>
                        <div class="col">Email:</div>
                    </div>
                    @foreach ($choferes as $chofer)
                    <div class="row d-flex">
                        <div class="col">{{$chofer['apellido']}}</div>
                        <div class="col">{{$chofer['DNI']}}</div>
                        <div class="col">{{$chofer['email']}}</div>
                        <div class="d-grid gap-2 d-md-block">
                            <form method="POST" action="{{ route('chofer.borrado', $chofer)}}">@csrf @method('DELETE')<button onclick="return ConfirmDelete() ">Eliminar ✖</button></form>
                        </div>
                        <div class="col">
                                <form method="GET" action="{{ route('chofer.update',$chofer)}}"><button onclick="return ConfirmEdit() ">Editar 📋</button></form></div>
                                <form method="GET" action="{{ route('chofer.perfil',$chofer)}}"><button >Ver perfil</button></form></div>
                        </div> 
                        
                    </div>
                    @endforeach
                </div>
        </div>
        
    @endsection
    @endsection

@isset($error)
@if($error == 'dni_error')
    <strong> El dni ingresado ya esta registrado <strong>
@endif
@if($error == 'email_error')
    <strong> El email ingresado ya esta registrado <strong>
@endif
@endisset
