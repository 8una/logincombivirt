
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
    

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Combis 19</h1>
            <h2>El servicio de viajes personalizados que buscas, seguro y confiable</h2>
        </div>

        {{-- BUSCADOR --}}
        <div class="border border-primary border-3 ">
            <form action="" class="m-2 p-2 ">
                <h3 class="m-2 p-2 ">Buscar un viaje</h3>
                <div class="d-flex ">            
                <input type="date" class="form-control w-25 m-2" name="fecha-viaje" id="" >
                <input type="date" class="form-control w-25 m-2" name="fecha-viaje" id="" >
                <input type="date" class="form-control w-25 m-2" name="fecha-viaje" id="" >
                <input type="date" class="form-control w-25 m-2" name="fecha-viaje" id="" >
                <button class="rounded-pill btn btn-primary">Buscar</button>
            </div>
            </form>
        </div>
        {{-- END BUSCADOR --}}
        {{--  --}}
        
<div class="container my-4 w-50">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <!-- Diapositivas -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="card border-primary mb-3 m-width-100">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Comentarios de nuestros pasajeros: </h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{asset('images/CARROUSEL.jpg')}}" alt="..." width="100%">
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($comments as $comentario)
            <div class="carousel-item">
                <div class="card border-primary mb-3 m-width-100">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">{{$comentario->nombre}}</h5>
                                <p class="card-text">{{$comentario->comentario}}</p>
                                <p class="card-text"><small class="text-muted">Puntuacion: {{$comentario->calificacion}} ⭐</small></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{asset('images/carrousel.jpg')}}" alt="" width="100%" height="100%">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Controles -->
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</div><!--//container-->

        {{--  --}}
        <div class="col-md-12">
            <h3>Viajes:</h3>


                <table class="table table-striped ">
                    <div class="container "">
                        <thead class="bg-primary">
                            <tr >
                                <th scope="col"><form action="{{ route('ordenarViaje')}}"><button class="btn btn-dark btn-lg" name="boton" value="1"> Ruta:</button></form></th>
                                <th scope="col" class="text-center"><form action="{{ route('ordenarViaje')}}"><button class="btn btn-dark btn-lg" name="boton" value="2"> Fecha:</button></form></th>
                                <th scope="col" class="text-center"><button class="btn btn-dark btn-lg" name="boton" value="3"> Hora:</button></th>
                                <th scope="col"><form action="{{ route('ordenarViaje')}}"><button class="btn btn-dark btn-lg" name="boton" value="3"> Precio:</button></form></th>
                            </tr>
                        </thead>
                @foreach ($data as $viaje)  
                <tr>

                    <tr>   
                        <th><div class="col text-left">{{$viaje['ruta']}}</th></div>
                        <th><div class="col text-center">{{$viaje['fecha']}} </th></div>
                        <th><div class="col text-center">{{$viaje['hora']}}  </th></div>
                        <th><div class="col text-left">{{$viaje['precio'] }}  $ARS </th></div>
                    </tr>
                </div>
                @endforeach
                </table> 
            </div>
        <div class="cartel-subscripcion class="col-md-12"" >
            <h2>Subscripcion</h2>
            <p>Crea tu cuenta y anotate a la subscripcion, 10% a todas tus compras a solo 250 $ARG x mes</p>
        </div>
        <div class="footer">
            <footer><small> Servicio funcional en la Republica Argentina</small></footer>
        </div>
    </div>

</div>

<!-- jQuery full con ajax -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>


@endsection
@endsection
</body>
</html>