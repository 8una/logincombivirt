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
            <h3>Viajes:</h3>
                <table border="1">
                <tr>
                    <td>Ruta:</td>
                    <td>Fecha:</td>
                    <td>Hora:</td>
                    <td>Precio:</td>
                </tr>
                @foreach ($data as $viaje)
                <tr>
                    <td>{{$viaje['ruta']}}</td>
                    <td>{{$viaje['fecha']}}</td>
                    <td>{{$viaje['hora']}}</td>
                    <td>{{$viaje['precio']}}</td>
                </tr>
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
