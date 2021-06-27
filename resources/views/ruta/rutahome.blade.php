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
<script type="text/javascript">
    function ConfirmDelete(){
        var respuesta=confirm("¿Estas seguro que deseas eliminar la ruta?, esto podria eliminar viajes con pasajeros");
        if (respuesta){
            return true;
        }
        return false;
    }
</script>

<body>
    @section('content')
    @include('layouts.navAdmin') 
        <h1 class="m-2">Administracion de Rutas</h1>
        
        <div class="bg-dark w-100 d-flex">
            <div class="border border-primary border-3 w-100 bg-light rounded-pill rounded-3 m-2 p-2">
                <form action="{{route('buscarRuta')}}" class="m-2 p-2 ">
                    @csrf
                    <h3 class="m-2 p-2 ">Buscar una Ruta</h3>
                    <div class="d-flex justify-content-center">
                        <input type="radio" class=" p-2 m-2 pr-3" name="rad" onclick="origen.disabled = false; destino.disabled= true;ruta.disabled= true; destino.value='N/A'; ruta.value='N/A' " />
                        <div><h6 class="text-secondary d-inline  mr-5">Origen</h6></div>
                        <input type="radio" class=" p-2 m-2 pr-3 mr-3" name="rad" onclick="origen.disabled = true; destino.disabled= false; ruta.disabled= true; origen.value='N/A'; ruta.value='N/A' " />
                        <div><h6 class="text-secondary d-inline pr-5 mr-5">Destino</h6></div>
                        <input type="radio" class=" p-2 m-2  mr-3" name="rad" onclick="origen.disabled = true; destino.disabled= true; ruta.disabled= false; destino.value='N/A'; origen.value='N/A' "  />

                        <div><h6 class="text-secondary d-inline pr-5 mr-5">Ruta</h6></div>
                    </div>
                    <div class="d-flex justify-content-center">           
                        

                        
                        <select class="form-select m-2" aria-label="Seleccione Ruta"  name="origen" id="origen" disabled="disabled" >
                            <option selected  id="n/a" value="N/A"><p class="text-secondary">N/A</p> </option>
                            @foreach ($origen as $origen)
                                <option value="{{$origen->nombre}}">{{$origen->nombre}}</option>
                            @endforeach 
                        </select>
                        
                        <select class="form-select  m-2" aria-label="Seleccione Ruta" name="destino" id="destino" disabled="disabled">
                            <option selected value="N/A" id="origen1"><p class="text-secondary">N/A</p> </option>
                            @foreach ($destino as $destino)
                                <option value="{{$destino->nombre}}">{{$destino->nombre}}</option>
                            @endforeach
                        </select>


                        <select class="form-select  m-2" aria-label="Seleccione Ruta" name="ruta" id="ruta" disabled="disabled">
                            <option selected value="N/A""><p class="text-secondary">N/A</p> </option>
                            @foreach ($ruta as $ruta)
                                <option value="{{$ruta->nombreRuta}}">{{$ruta->nombreRuta}}</option>
                            @endforeach
                        </select>
                    <button class="rounded-pill btn btn-primary">Buscar</button>
                </div>
                </form>
            </div>
        </div>
        <div class="d-flex">
            <button class="btn btn-outline-dark ml-2 h-75 mt-2 w-25"> <a href= "{{route('crearRuta')}}" >Cargar nueva Ruta</a></button>
            <button class="btn btn-outline-dark ml-2 h-75 mt-2"> <a href= "{{route('crearCiudad')}}" >Agregar Ciudad</a></button>
            <button class="btn btn-outline-dark ml-2 h-75 mt-2"> <a href= "{{route('quitarCiudad')}}" >Quitar Ciudad</a></button>
            
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
                    @if (!$data->isEmpty())
                        @foreach ($data as $data)
                            <tr>   
                                <th><div class="col">{{$data['nombreRuta']}}</th></div>
                                <th>
                                    <div class="d-flex ">
                                        <div class="pr-2"><form method="POST" action="{{ route('ruta.borrar', $ruta)}}">@csrf @method('DELETE')<button class="btn btn-outline-danger" onclick="return ConfirmDelete()">Eliminar ✖</button></form></div>
                                    </div>
                                </th> 
                            </tr>
                        </div>
                        @endforeach
                    @else
                    <tr>   
                        <th><div class="col text-secondary text-center" >No hay informacion</th></
                        </tr>
                    @endif
                    
            </table>
                </div>
                
        </div>
        
    @endsection
</body>
</html>
@endif