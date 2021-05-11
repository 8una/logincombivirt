@extends('layout.plantilla');

@section("cabecera")
    
@section("contenido")
<div >
	<h1>¿Deseas eliminar el registro de {{ $item->nombre }} ? </h1>

<form method="POST" action="{{route ('item.borrado', $item )}}">
    @csrf @method('DELETE')
	
	<button type="submit" >
		 Eliminar
	</button>
    </form>	   
    @csrf
    <form method="GET" action="{{route('borrar.cancelarI' )}}">
    @csrf @method('DELETE')
	
	<button type="submit" >
		 Cancelar
	</button>
    @csrf
</form>	
<li><a href="{{route('home')}}">Administración</a></li>

</div>