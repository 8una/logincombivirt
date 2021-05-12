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
<body>
    @section('content')
    @section('contentAdmin')

    <h1>Seleccion de Combi y Chofer</h1>
        <br>
        <table>
            <form method="POST" action="{{ route('crearviaje')}}  ">
                @csrf 
                
                <h2 class=" m-2 p-2">Eleccion De Combi y Chofer</h2>
                <label for=""></label>
                    <h4 class="d-inline m-2 p-2">Combi:</h4>
                    <p class="d-inline m-2 p-2">Usted tiene para elegir: {{$cantCombis}} Combis</p>
                    <select name="patente">
                    @foreach ($data as $item)
                        <option value="{{$item->patente}}">{{$item->patente}}</option>
                    @endforeach 
                    </select>
                </label>
                
                <label for=""></label>
                    <h4 class="d-inline m-2 p-2 ml-5 pl-5">Chofer:</h4>
                    <p class="d-inline m-2 p-2 ">Usted tiene para elegir: {{$cantChoferes}} Choferes</p>
                    <select name="dni">
                    @foreach ($choferes as $choferes)
                        <option value="{{$choferes->DNI}}">{{$choferes->DNI}}</option>
                    @endforeach 
                    </select>
                </label>
                <hr>
                <h2 class=" m-2 p-2">Datos del viaje:</h2>
                <label for=""></label>
                    <h4 class="d-inline m-2 p-2">Ruta:</h4>
                    <input class="form-control" name="ruta" value="{{$ruta}}" type="text"  placeholder="{{$ruta}}" aria-label="readonly input example" readonly>
                </label>
                <br>
                <label for=""></label>
                <h4 class="d-inline m-2 p-2">Fecha:</h4>
                    <input class="form-control" name="fecha" value="{{$fecha}}" type="text"  placeholder="{{$fecha}}" aria-label="readonly input example" readonly>    
                </label>
                <br>
                <label for=""></label>
                <h4 class="d-inline m-2 p-2">Hora:</h4>
                <input class="form-control" name="hora" value="{{$hora}}" type="text" placeholder="{{$hora}}" aria-label="readonly input example" readonly>
                </label>
                <br>
                <label for=""></label>
                    <h4 class="d-inline m-2 p-2">Duracion: <h6 class="d-inline">(Hs)</h6></h4>
                    <input class="form-control" name="duracion" value="{{$duracion}}" type="text" placeholder="{{$duracion}}" aria-label="readonly input example" readonly>
                </label>
                <br>
                <label for=""></label>
                    <h4 class="d-inline m-2 p-2">Precio:</h4>
                    <input class="form-control" name="precio" value="{{$precio}}"  type="text" placeholder="{{$precio}}" aria-label="readonly input example" readonly>
                </label>
                <div class="m-2 p-2">
                    <button class="btn btn-primary">Finalizar</button>
                    <button type="button" class="btn btn-outline-secondary"> <a href="{{route('gestionDeViajes')}}">Cancelar</a></button>
                </div>
            </form>
    @endsection
    @endsection
</body>
</html>    
