@extends('layout.plantilla');

@section("cabecera")
    
@section("contenido")
<div >
	<h1>¿Deseas eliminar el registro de {{ $chofer->nombre }} {{ $chofer->apellido }}? </h1>

<form method="POST" action="{{route ('chofer.borrado', $chofer )}}">
    @csrf @method('DELETE')
	
	<button type="submit" >
		 Eliminar
	</button>
    </form>	   
    @csrf
    <form method="GET" action="{{route('borrar.cancelarC' )}}">
    @csrf @method('DELETE')
	
	<button type="submit" >
		 Cancelar
	</button>
    @csrf
</form>	
<li><a href="{{route('home')}}">Administración</a></li>

</div>