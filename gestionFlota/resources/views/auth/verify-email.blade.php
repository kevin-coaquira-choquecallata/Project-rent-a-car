@extends('layouts.guest')

@section('content')
<div class="container text-center py-5">
    <h2 class="mb-4">Verifica tu correo electrónico</h2>

    <p class="text-muted">
        Gracias por registrarte. Por favor, verifica tu dirección de correo haciendo clic en el enlace que te enviamos.
        <br>
        Si no recibiste el correo, puedes solicitar otro.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mt-3">
            Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-primary">Reenviar correo de verificación</button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-2">
        @csrf
        <button type="submit" class="btn btn-link text-danger">Cerrar sesión</button>
    </form>
</div>
@endsection
