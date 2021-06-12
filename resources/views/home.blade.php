
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
    <script type="text/javascript">
        function chequearDiferentesOrigenesYDestinos(){
            var origen = document.getElementById("origen").value;
            var destino = document.getElementById("destino").value;
            if ((origen == destino)&&(origen !='N/A')){
                alert("El origen y el destino no pueden ser iguales");
            return false;
        }
    }
</script>
    </script>
@section('content')
@section('content2')
    

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Combis 19</h1>
            <h2>El servicio de viajes personalizados que buscas, seguro y confiable</h2>
        </div>
       
        {{-- BUSCADOR --}}
        <div class="bg-dark w-100 d-flex justify-content-center">
            <div class="border border-primary border-3 w-100 bg-light rounded-pill rounded-3 m-2 p-2  ">
                <form action="{{route('buscarViaje')}}"  class="m-2 p-2 ">
                    <h3 class="m-2 p-2 ">Buscar un viaje</h3>
                    <div class="d-flex">
                        <input type="radio" class=" p-2 m-2 pr-3 mr-3" name="rad" onclick="origen.disabled = false; destino.disabled= true;ruta.disabled= true; destino.value='N/A'; ruta.value='N/A' " />
                        <div><h6 class="text-secondary d-inline pr-5 mr-5">Origen</h6></div>
                        <input type="radio" class=" p-2 m-2 pr-3 mr-3" name="rad" onclick="origen.disabled = true; destino.disabled= false; ruta.disabled= true; origen.value='N/A'; ruta.value='N/A' " />
                        <div><h6 class="text-secondary d-inline pr-5 mr-5">Destino</h6></div>
                        <input type="radio" class=" p-2 m-2 pr-3 mr-3" name="rad" onclick="origen.disabled = true; destino.disabled= true; ruta.disabled= false; destino.value='N/A'; origen.value='N/A' "  />

                        <div><h6 class="text-secondary d-inline pr-5 mr-5">Ruta</h6></div>
                        <div><h6 class="text-secondary d-inline pl-3 ml-3 mr-5 pr-5">Desde</h6></div>
                        <div><h6 class="text-secondary d-inline pl-5 ml-5">Hasta</h6></div>
                    </div>
                    <div class="d-flex ">           
                        

                        
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
                    
                        <input size="16" type="date" class="datepicker m-2 p-2 w-25" id="desde" min="{{now()->format('Y-m-d')}}" value="{{now()->format('Y-m-d')}}" name="desde"> 
                        <input size="16" type="date" class="datepicker m-2 p-2 w-25" id="hasta"   name="hasta" onclick="min=desde.value"> 
                    <button class="rounded-pill btn btn-primary" onclick="return chequearDiferentesOrigenesYDestinos() ">Buscar</button>
                </div>
                </form>
            </div>
        </div>
        {{-- END BUSCADOR --}}
        {{--  --}}
        <div class="container">
            <div class="row">
              <div class="col">
                <div class="container my-4 w-100  rounded-pill" >
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <!-- Diapositivas -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="card border-primary mb-3 m-width-100">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <h5 class="card-title">Comentarios de nuestros pasajeros en los ultimos viajes: </h5>
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
                                                <h5 class="card-title"> {{$comentario->nombre}} </small></h5>
                                                <p class="card-text">{{$comentario->comentario}}</p>
                                                <p class="card-text"><small class="text-muted">Puntuacion: {{$comentario->calificacion}} ⭐</small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="{{asset('images/carrouselo.jpg')}}" alt="" width="100%" height="100%">
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
            </div>
            <div class="col">
                <div class="container my-4 w-100  rounded-pill" >
                    <div class="card border-primary mb-3 m-width-100">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{asset('images/carrouselo.jpg')}}" alt="..." width="100%">
                            </div>
                            <div class="col-md-6">
                                
                                <div  class="card-title"> Subscribite</div>
                                <div class="card-text">Y recibi descuentos del 10% en todas tus compras</div>
                                <p class="card-text"><small class="text-muted">A solo 250$ ARS x Mes</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        {{--  --}}
        <div class="col-md-12">
            <hr>
                <p>{{$msg}}</p>
            <hr>
            <h3>Viajes:</h3>
        

                <table class="table table-striped ">
                    <div class="container "">
                        <thead class="bg-primary">
                            <tr >
                                <th scope="col"><form action="{{ route('ordenarViaje')}}"><button class="btn btn-dark btn-lg" name="boton" value="1"> Ruta:</button></form></th>
                                <th scope="col" class="text-center"><form action="{{ route('ordenarViaje')}}"><button class="btn btn-dark btn-lg" name="boton" value="2"> Fecha:</button></form></th>
                                <th scope="col" class="text-center"><button class="btn btn-dark btn-lg" name="boton" value="3"> Hora:</button></th>
                                <th scope="col"><form action="{{ route('ordenarViaje')}}"><button class="btn btn-dark btn-lg" name="boton" value="3"> Precio:</button></form></th>
                                <th scope="col"><form action="{{ route('ordenarViaje')}}"><button class="btn btn-dark btn-lg" name="boton" value="3"> Acciones:</button></form></th>
                            </tr>
                        </thead>
                @if (!$data->isEmpty())
                    @foreach ($data as $viaje)  
                    <tr>
                        <tr>   
                            <th><div class="col text-left">{{$viaje->ruta}}</th></div>
                            <th><div class="col text-center">{{$viaje->fecha}} </th></div>
                            <th><div class="col text-center">{{$viaje->hora}}  </th></div>
                            <th><div class="col text-left">{{$viaje->precio}}  $ARS </th></div>
                            <th><div class="col text-left"> <a href = "{{ route('compraViaje',$viaje->id)}}"class="btn btn-outline-success">🛒</a> </th></div>
                        </tr>
                    </div>
                    @endforeach
    
                    
                @else<tr>
                    <tr>   
                        <th><div class=" text-center"> <h3 class="text-center text-secondary"> No hay viajes disponibles...</h3></th></div>
                @endif
                
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

