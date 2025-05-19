@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-4">🚫 Acceso denegado</h1>
    <p class="lead">No tienes permisos para acceder a esta sección.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Volver al inicio</a>
</div>
@endsection
