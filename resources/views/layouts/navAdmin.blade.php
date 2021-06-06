<div class="bg-dark">
   
    <div class="container ">
        <div class="row m-2 p-2 justify-content-center">
            <div class="col-3 ">
            <button type="button" class="btn btn-primary btn-lg w-100 h-100" ><a href="{{route("gestionDeViajes")}}" class="text-dark"> Administracion de Viajes</a></button>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary btn-lg w-100 h-100" ><a href="{{route("gestionDeCombis")}}" class="text-dark"> Administracion de Combis</a></button>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary btn-lg w-100 h-100"><a href="{{route("gestionDeCombis")}}" class="text-dark"> gestion De Cuentas</a></button>
            </div>
    </div>
    <div class="row m-2 p-2 justify-content-center">
        
        <div class="col-3">
            <button type="button" class="btn btn-primary btn-lg w-100 h-100" ><a href="{{route("item.index")}}"" class="text-dark"> gestion De Items</a></button>
            </div>
        
        <div class="col-3">
            <button type="button" class="btn btn-primary btn-lg w-100 h-100"><a href="{{route("chofer.index")}}"" class="text-dark"> gestion De Choferes</a></button>
        </div>

        <div class="col-3">
            <button type="button" class="btn btn-primary btn-lg w-100 h-100" ><a href="{{route("ruta.index")}}"" class="text-dark">Rutas</a></button>
        </div>
    </div>
</div>
</div>

@yield('content2')