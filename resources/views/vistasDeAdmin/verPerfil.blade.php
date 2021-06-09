@extends('layouts.app')
@section('content')
@if (!Auth::user())
Usted no tiene permiso para visualizar esta página. 

@elseif($request->user()->authorizeRoles(['admin']))
@include('layouts.navAdmin') 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <h1>@foreach ($data as $u)
                                        {{$u['name']}} {{$u['lastname']}}
 </h1></div> 

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
             
           

                    Email: {{$u['email']}}<br>
                    DNI:{{$u['dni']}}<br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif