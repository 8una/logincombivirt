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
        var respuesta=confirm("¿Estas seguro que desea anular su suscripción?");
        if (respuesta){
            return true;
        }
        return false;
    }

 
</script>
<body>
@section('content')
<div>
<button type="button" class="btn btn-outline-primary"><a href="{{route('home')}}"> Atras </a></button> </div>

        <div><h1> Tarjetas que dispone:  </h1></div>
        <table class="table table-striped ">
                <div class="container ">  
                    <thead class="bg-primary">
                       
                    </thead>                
            @foreach ($tarjetas as $tarjeta)
            <div>

            <form method="GET" action="">
            @csrf
            
            <label for="">Numero de tarjeta terminada en <br>
            <div>
                <input type="text" name="numero" value = "{{$tarjeta}}" required minlength="2" maxlength="10" >
                
            </div>
            </div>

        </form>

                    @endforeach
                </div>
                
        </table> 
        <div class="btn btn-outline-primary">
                        <a href="{{route('showAgregarTarjeta')}}">Agregar una Tarjeta</a>
                    </div> 
        <div>                      
               
            <form method="POST"  action="{{route('anularSuscripcion')}}">@csrf @method('DELETE')<button class="btn btn-outline-primary" onclick="return ConfirmDelete() ">Anular suscripción</button></form>
        </div>
        
        <p>{{$data}}</p>

    @endsection
</body>
</html>