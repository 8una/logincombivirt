<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        
  <div class="d-flex bg-dark">
    <img  src="{{ asset('images/logo_is.png') }}" alt="" width="100" height="100">
     <div class=""">
        <div class="d-flex text-light h2 align-middle pt-5 ml-2 mr-2 "  >
          <button class="btn btn-dark btn-lg"><div class="ml-2" ><a class="text-light" href="{{route('home')}}"> Inicio</a></div></button>
          <button class="btn btn-dark btn-lg"><div class="ml-2"><a class="text-light" href="{{route('misViajes', Auth::user()->DNI)}}"> Mis viajes </a></div></button>
          <button class="btn btn-dark btn-lg"><div class="ml-2"><a href="" class="text-light"> Historial </a></div></button>
          <button class="btn btn-dark btn-lg"><div class="ml-2"><a href="" class="text-light"> Subscripcion </a></div></button>
        </div>        
     </div>
  </div>
    @yield('content2')
</body>
</html>