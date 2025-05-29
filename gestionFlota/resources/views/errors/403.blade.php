@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-4">🚫 Acceso denegado</h1>
    <p class="lead">No tienes permisos para acceder a esta sección.</p>

    @php
        $ruta = match (auth()->user()?->role?->nombre) {
            'admin' => '/admin/usuarios',
            'oficina' => '/oficina',
            'lavadero' => '/lavadero',
            'mecanico' => '/mecanico',
            default => '/',
        };
    @endphp

    <a href="{{ url($ruta) }}" class="btn btn-primary mt-4">
        Ir a mi panel
    </a>
</div>
@endsection
