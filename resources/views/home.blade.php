@extends('layouts.nav')
@extends('layouts.app')


@section('content')
@section('content2')
    

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Combis 19</h1>
            <h2>El servicio de viajes personalizados que buscas, seguro y confiable</h2>
        </div>
        <div class="col-md-12">
        <br><br><br>
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
@endsection
@endsection
