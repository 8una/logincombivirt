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
    <h1 class="m-2">Gestion de choferes</h1>
        <div>
            <button class="btn btn-outline-primary ml-2" > <a href="{{route('chofer.crear')}}"> Crear Chofer  </a></button>
            
        </div>
        <div>
            
       
        <h3 class="m-2">Choferes:</h3>
            <hr>
                {{$msg}}
            <hr>

        <table class="table table-striped ">
                <div class="container ">  
                    <thead class="bg-primary">
                        <tr>
                            <th scope="col">Apellido:</th>
                            <th scope="col" class="text-center">DNI:</th>
                            <th scope="col" class="text-center">Email:</th>
                            <th scope="col">Acciones:</th>
                        </tr>
                    </thead>                
                    @foreach ($choferes as $chofer)
                    <tr>
                            <th><div class="col ">{{$chofer['apellido']}}</th></div>
                            <th><div class="col text-center">{{$chofer['DNI']}}</th></div>
                            <th><div class="col text-center">{{$chofer['email']}}</th></div>
                        <th>
                            <div class="d-flex">
                                <div class="pr-2"><form method="POST" action="{{ route('chofer.borrado', $chofer)}}">@csrf @method('DELETE')<button onclick="return ConfirmDelete() ">Eliminar ✖</button></form></div>
                                <div class="pl-2"><form method="GET" action="{{ route('chofer.update',$chofer)}}"><button onclick="return ConfirmEdit() ">Editar 📋</button></form></div>
                                <div class="pr-2"><form method="GET" action="{{ route('chofer.perfil',$chofer)}}"><button >Ver perfil</button></form></div>
                            </div> 
                        </th>
                    </tr>
                    @endforeach
                </div>
        </table>      
        </div>
        
    @endsection

@isset($error)
@if($error == 'dni_error')
    <strong> El dni ingresado ya esta registrado <strong>
@endif
@if($error == 'email_error')
    <strong> El email ingresado ya esta registrado <strong>
@endif
@endisset
