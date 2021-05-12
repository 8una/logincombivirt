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
                    DNI:{{Auth::user()->DNI}}<br>
                    <a href="misViajes/{{Auth::user()->DNI}}">Mis Viajes</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection