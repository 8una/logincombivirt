@extends('layouts.app')
@if (!Auth::user())
Usted no tiene permiso para visualizar esta página. 

@elseif($request->user()->authorizeRoles(['admin']))
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>


{{-- <script type="text/javascript">
    function ConfirmDelete(){
        var respuesta=confirm("¿Estas seguro que deseas eliminar la cuenta?");
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
</script> --}}




<body>
    @section('content')
    @include('layouts.navAdmin') 
        <h1 class="m-2">Gestion de cuentas</h1>
        <div class="d-flex">
        
            {{-- <button class="btn btn-outline-dark ml-2 h-75 mt-2" > <a href="{{route('crearCombi')}}"> Crear Combi  </a></button> --}}
            
            <form method = 'POST' action = "{{route('buscarCuenta')}}" ><input class="btn btn-outline-dark ml-2 m-2 h-75 justify-content-right" type = "submite" name = "email" placeholder="Email de Cuenta a Buscar">@csrf</input>
            </form>
        </div>

        <div>
            <h3 class="m-2">Cuentas:</h3>
            <hr>
                <p class="m-2">{{$mensaje}}</p>
            <hr>
            <table class="table table-striped ">
                <div class="container "">
                    <thead class="bg-primary">
                        <tr >
                            <th scope="col">Nombre:</th>
                            <th scope="col" class="text-center">Email:</th>
                            <th scope="col" class="text-center">DNI:</th>
                            <th scope="col">Acciones:</th>
                        </tr>
                    </thead>
                    @foreach ($data as $user)
                        <tr>   
                            <th><div class="col">{{$user['name']}}</th></div>
                            <th><div class="col text-center">{{$user['email']}} </th></div>
                            <th><div class="col text-center">{{$user['dni']}}  </th></div>
                            <th>
                                <div class="d-flex ">
                                    
                                    <div class="pr-2"><form method="GET" action="{{ route('verPerfil',$user)}}"><button >Ver perfil</button></form></div>
                                    {{-- <div class="pr-2"><form method="POST" action="{{ route('combi.borrar', $user)}}">@csrf @method('DELETE')<button class="btn btn-outline-danger" onclick="return ConfirmDelete() ">Eliminar ✖</button></form></div> --}}
                                    {{-- <div class="pl-2"><form method="POST" action="{{ route('combi.actualizar',$user)}}">@csrf @method('PATCH')<button  class="btn btn-primary ml-2" onclick="return ConfirmEdit() ">Editar 📋</button></form></div> --}}
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
@endif