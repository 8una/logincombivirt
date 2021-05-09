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
<body>
    @section('content')
    @section('content2')
        <div>Cargar una nueva combi</div>    
        <form method="POST" action="{{ route('combi.store')}}">
            @csrf
            <label for="">Patente de combi <br>
                <input type="text" name="patente" required minlength="6" maxlength="7" placeholder="Ingrese Patente sin espacios">
            </label><br>
            <label for="">Tipo de Combi</label>
                <select name="tipo">
                    <option value="1">Comoda</option>
                    <option value="2">Super Comoda</option>
                </select>
            </label>
            <br>
            <button class="bg-primary">Enviar</button>
            <button><a href="http://localhost/ProjectBar/logincombivirt/public/gestionCombis"> Atras </a></button> 
        </form>
        <p>{{$data}}</p>
        
        

    @endsection
    @endsection
</body>
</html>