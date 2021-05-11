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
        <div><h1> Cargar una nueva combi </h1></div>   
        <form method="POST" action="{{ route('combi.store')}}">
            @csrf
            <br><br>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label "><h3>Patente de la Nueva Combi:</h3></label>
                <input type="text" class="form-control ml-1" name='patente' id="exampleFormControlInput1" placeholder="Ingrese la patente sin espacios">
            </div>
            <br>
            <div class="mb-3">
            <label for=""><h3>Tipo de Combi: </h3></label>
                <div  class="ml-2">
                    <select class="form-select" aria-label="Default select example" name='tipo'>
                        <option value="1">Comoda</option>
                        <option value="2">Super-Comoda</option>
                    </select>
            </div>
            </label>
            <br>
            <button class="btn btn-primary ml-2" type="submit">Enviar</button>
            <button type="button" class="btn btn-outline-primary"><a href="{{route('gestionDeCombis')}}}}"> Atras </a></button>
        </form>
        <hr>
        <p class="fw-bold m-2" >{{$data}}</p>
        
        

    @endsection
    @endsection
</body>
</html>