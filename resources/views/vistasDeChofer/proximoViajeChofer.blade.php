@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<script>
    function ConfirmDelete(){
        var respuesta=confirm("¿Esta seguro que deseas rechazar al pasajero?");
        if (respuesta){
            return true;
        }
        return false;
    }
</script>
<body>
    @section('content')
    <h1>Proximo viaje a realizar</h1>
    <table class="table table-striped ">
        <div class="container "">
            <thead class="bg-primary">
                <tr >
                    <th scope="col">Ruta:</th>
                    <th scope="col" class="text-center"> Fecha:</th>
                    <th scope="col" class="text-center">Hora:</th>
                    <th scope="col"> Acciones:</th>
                </tr>
            </thead>
    @if (!$proximoViaje->isEmpty())
        @foreach ($proximoViaje as $viaje)  
        <tr>
            <tr>   
                <th><div class="col text-left">{{$viaje->ruta}}</th></div>
                <th><div class="col text-center">{{$viaje->fecha}} </th></div>
                <th><div class="col text-center">{{$viaje->hora}}  </th></div>
                <th>
                <div class="d-flex">
                    <div><button> Cancelar   </button></div>
                    <div><form method="POST" action="{{route('iniciarViaje',$viaje->id)}}"> @csrf<button> Iniciar </button> </form></div>    
                </div> 
                </th>
            </tr>
        </div>
        @endforeach
    @endif
    </table>
    @if ($estado =='arribando')
        <div class="bg-success">Arribando</div>
    @else
        <div class="bg-dark text-white">Inactivo</div>
    @endif

    <h3 class="m-2 p-2">Pasajeros anotados:</h3>
    <table class="table table-striped w-50 ">
        <div class="container "">
            <thead class="bg-primary">
                <tr>
                    <th scope="col" class="text-center">DNI:</th>
                    <th scope="col"   class="text-center "> Acciones:</th>
                </tr>
            </thead>
    @if (!$viajeros->isEmpty())
        @if ($estado =='arribando')
            @foreach ($viajeros as $data)  
            <tr>
                <tr>   
                    <th><div class="col text-center">{{$data->dniusuario}}  </th></div>
                    @if($data->estado == "en viaje") 
                        <th> 
                            <div class="d-flex ml-5 mr-5 pl-5 bg-success"> 
                            <div class="bg-success"> {{$data->estado}}</div>
                        </div>
                        </th>
                        
                    @elseif($data->estado == "cancelado" )
                        <th> 
                            <div class="d-flex ml-5 mr-5 pl-5 bg-danger"> 
                            <div class="bg-danger"> {{$data->estado}}</div>
                            </div>
                        </th>
                    @else
                        <th> 
                            <div class="d-flex ml-5 mr-5 pl-5 "> 
                            <div><form action="{{route('cargarDeclaracionJurada',$data->dniusuario)}}">@csrf<button> Cargar Declaracion Jurada</button></form></div>
                            <div><form action="{{route('rechazarPasajero',$data->dniusuario)}}" method="POST">@csrf<button onclick="return ConfirmDelete()"> Rechazar Pasajero </button></form></div>    
                        </div>
                        </th>
                    @endif
                </tr>
            </div>
            @endforeach 
        @else
            @foreach ($viajeros as $data)
                <th> 
                    <div class="d-flex ml-5 mr-5 pl-5 "> 
                    <div><form action="{{route('cargarDeclaracionJurada',$data->dniusuario)}}" >@csrf<button class="bg-secondary text-light" disabled> Cargar Declaracion Jurada</button></form></div>
                    <div><form action="{{route('rechazarPasajero',$data->dniusuario)}}" method="POST">@csrf<button  class="bg-secondary text-light" onclick="return ConfirmDelete()" disabled> Rechazar Pasajero </button></form></div>    
                </div>
                </th>
            @endforeach 
        @endif
    @endif     
    </table>   
    @endsection
</body>
</html>
