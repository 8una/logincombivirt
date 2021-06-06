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
    @include('layouts.navAdmin') 
    <hr><h5>{{$msg}}</h5>
    <h1>Crear Nuevo viaje</h1>

        <br>
        <table>
            <form method="" action="{{ route('selectCombiYChofer')}} ">
                @csrf 
                <label for=""></label>
                    <h3 class="d-inline m-2 p-2">Ruta:</h3>
                    <select name="combo">
                        @foreach ($data as $item)
                            <option name="ruta" value="{{($item['nombreRuta'])}}">{{$item['nombreRuta']}}</option>
                        @endforeach
                    </select>
                </label>
                <br>
                <label for=""></label>
                <h3 class="d-inline m-2 p-2">Fecha:</h3>
                    <input type="date" name="fecha" id="" min={{ now()->format('Y-m-d')}} required value="{{old('fecha')}} ">
                </label>
                <br>
                <label for=""></label>
                <h3 class="d-inline m-2 p-2">Hora:</h3>
                    <input type="time" name="hora" id="" required value="{{old('hora')}}">
                </label>
                <br>
                <label for=""></label>
                    <h3 class="d-inline m-2 p-2">Duracion: <h6 class="d-inline">(Hs)</h6></h3>
                    <input type="number" name="duracion" id=""  required value="{{old('duracion')}}" >
                </label>
                <br>
                <label for=""></label>
                    <h3 class="d-inline m-2 p-2">Precio:</h3>
                    <input type="number" name="precio" id="" required value="{{old('precio')}}">
                </label>
                <div class="m-2 p-2">
                    <button class="btn btn-primary">Siguiente</button>
                    <button type="button" class="btn btn-outline-secondary"> <a href="{{route('gestionDeViajes')}}">Atras</a></button>
                </div>
            </form>
        </table> 
    @endsection
</body>
</html>

