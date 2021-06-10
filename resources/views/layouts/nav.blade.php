
        
  <div class="d-flex bg-dark">
   
     <div>
        <div class="text-light">
           @guest{{-- ACA VAN LAS COSAS EN LA NAVEGACION QUE SE LE MUESTRAN A UNA PERSONA NO LOGEADA--}}
          <button class="btn btn-dark btn-lg "><div class="ml-2" ><a class="text-light" href="{{route('home')}}"> Inicio</a></div></button>
          <button class="btn btn-dark btn-lg "><div class="ml-2" ><a class="text-light" href=""> Buscar Viaje</a></div></button>
          <button class="btn btn-dark btn-lg "><div class="ml-2" ><a class="text-light" href=""> Subscripcion</a></div></button>

        @endguest
         {{-- ACA LAS DE USUARIO REGISTRADO--}}
         
        
          @if (Auth::user())
          <button class="btn btn-dark btn-lg"><div class="ml-2" ><a class="text-light" href="{{route('home')}}"> Inicio</a></div></button>
          <button class="btn btn-dark btn-lg"><div class="ml-2"><a class="text-light" href="{{route('misViajes', Auth::user()->dni)}}"> Mis viajes </a></div></button>
          <button class="btn btn-dark btn-lg"><div class="ml-2"><a href="{{route('misViajesPasados', Auth::user()->dni)}}" class="text-light"> Historial </a></div></button>
          <button class="btn btn-dark btn-lg"><div class="ml-2"><a href="" class="text-light"> Subscripcion </a></div></button>
          {{-- @elseif (Auth::user()->authorizeRoles(['1']))
          
          <button class="btn btn-dark btn-lg"><div class="ml-2"><a href="{{route('uAdmin')}}" class="text-light"> Administración</a></div></button>
          @endif --}}
          @endif
          
      
        
        </div>        
     </div>
  </div>
    @yield('content2')
