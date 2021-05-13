<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <title>Combis-19</title>
</head>
<body>
        
  <div class="d-flex bg-dark">
   
     <div>
        <div class="text-light">
          @guest {{-- ACA VAN LAS COSAS EN LA NAVEGACION QUE SE LE MUESTRAN A UNA PERSONA NO LOGEADA--}}
          <button class="btn btn-dark btn-lg "><div class="ml-2" ><a class="text-light" href="{{route('home')}}"> Inicio</a></div></button>
          <button class="btn btn-dark btn-lg "><div class="ml-2" ><a class="text-light" href=""> Buscar Viaje</a></div></button>
          <button class="btn btn-dark btn-lg "><div class="ml-2" ><a class="text-light" href=""> Subscripcion</a></div></button>

          @endguest
          @auth{{-- ACA LAS DE USUARIO REGISTRADO--}}
          <button class="btn btn-dark btn-lg"><div class="ml-2" ><a class="text-light" href="{{route('home')}}"> Inicio</a></div></button>
          <button class="btn btn-dark btn-lg"><div class="ml-2"><a class="text-light" href="{{route('misViajes', Auth::user()->DNI)}}"> Mis viajes </a></div></button>
          <button class="btn btn-dark btn-lg"><div class="ml-2"><a href="{{route('misViajes', Auth::user()->DNI)}}" class="text-light"> Historial </a></div></button>
          <button class="btn btn-dark btn-lg"><div class="ml-2"><a href="" class="text-light"> Subscripcion </a></div></button>
        @endauth
        </div>        
     </div>
  </div>
    @yield('content2')
</body>
</html>