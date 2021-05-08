@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verificar tu correo electrónico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado un link de verificación a su correo electrónico.') }}
                        </div>
                    @endif

                    {{ __('Antes de proceder, por favor confirme su correo electrónico.') }}
                    {{ __('Si no ha recibido ningún correo,') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('presione aquí para reenviar el mensaje.') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
