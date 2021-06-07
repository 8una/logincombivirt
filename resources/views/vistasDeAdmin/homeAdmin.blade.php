@extends('layouts.app')
@if($request->user()->authorizeRoles(['admin']))
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    
</head>
<body>
    @section('content')
       
         {{-- 
        <div class="border border-primary border-3 ">
            <form action="" class="m-2 p-2 ">
                <h3 class="m-2 p-2 ">Buscar un viaje</h3>
                <div class="d-flex ">
                <input type="text" class="form-control w-25 m-2" name="Ruta" id="" placeholder="ruta">
                <input type="date" class="form-control w-25 m-2" name="fecha-viaje" id="">
                <input type="number" class="form-control w-25 m-2" name="cantidad-pasajes" id="" placeholder="cant pasajes" min="1">
                <button class="rounded-pill btn btn-primary">Buscar</button>
            </div>
            </form>
            </div> --}}
            @include('layouts.navAdmin')

    @endsection
</body>
</html>
@endif