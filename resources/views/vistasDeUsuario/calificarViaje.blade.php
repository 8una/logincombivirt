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
        <form  method="POST" action={{route('usuarioCalificaViaje', [$viaje])}}>
            @csrf
            <div class="d-flex p-2 m-2">
                <div class="form-check form-check-inline" >
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" required>
                    <label class="form-check-label" for="inlineRadio1">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="2" required>
                    <label class="form-check-label" for="inlineRadio1">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="3" required>
                    <label class="form-check-label" for="inlineRadio1">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="4" required>
                    <label class="form-check-label" for="inlineRadio1">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="5" required>
                    <label class="form-check-label" for="inlineRadio1">5</label>
                </div>
            </div>
            <textarea class="m-2 p-2"name="comentario" id="" cols="60" rows="5" placeholder="Deje su comentario" required maxlength="50"></textarea>
            <div class="m-2 p-2">
                <button class="btn btn-primary">Calificar</button>
                <button type="button" class="btn btn-outline-secondary"> <a href="{{route('viajesDelUsuario')}}">Atras</a></button>
            </div>
        </form>
    @endsection
    @endsection
</body>
</html>