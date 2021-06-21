@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{Auth::user()->name}} {{Auth::user()->lastname}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Email: {{Auth::user()->email}}<br>
                    DNI:{{Auth::user()->dni}}<br>

                    <a href="misViajes/{{Auth::user()->dni}}">Mis Viajes</a>
                </div>
                <hr>
                @if (!empty($tarjetas))
                <div class="card-body h5"> Tarjetas:</div>
                <table class="table table-striped ">
                    <div class="container "">
                        <thead class="bg-dark text-light">
                            <tr >
                                <th scope="col"> Tarjeta terminada en:</button></form></th>
                            </tr>
                        </thead>
                    
                        @foreach ($tarjetas as $tarjetas)
                            <tr>   
                                <th><div class="col text-left">{{$tarjetas}}</th></div>
                            </tr>
                        @endforeach
                </table>
                    <hr>
                    <div class="card-body">
                        <a href="{{route('showAgregarTarjeta')}}">Agregar una Tarjeta</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection