@extends('layout')
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
       <h1>Crear Nuevo viaje</h1>
        <br>
        <form method="POST" action="{{ route('viaje.SeleccionDeCombi')}}">
            @csrf 
            <label for=""></label>
                Ruta:
                <select name="combo">
                    <!-- Opciones de la lista -->
                    @foreach ($data as $item)
                        <option name="ruta" value="{{($item['ruta'])}}">{{$item['ruta']}}</option>
                    @endforeach
                </select>
            </label>
            <br>
            <label for=""></label>
                Fecha: 
                <input type="date" name="fecha" id="" min="2021-7-5" required value="{{old('fecha')}} ">
            </label>
            <br>
            <label for=""></label>
                Hora:
                <input type="time" name="hora" id="" required value="{{old('hora')}}">
            </label>
            <br>
            <label for=""></label>
                Duracion en Hs:
                <input type="number" name="duracion" id=""  required value="{{old('duracion')}}" >
            </label>
            <br>
            <label for=""></label>
                Precio:
                <input type="number" name="precio" id="" required value="{{old('precio')}}">
            </label>
            
            <button >Continuar</button>
            <button> <a href="/gestionDeViajes"> Cancelar</a></button>
        </form>
    @endsection
</body>
</html>

