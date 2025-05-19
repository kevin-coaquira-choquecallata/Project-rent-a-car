@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="mb-4">👤 Usuario sin rol asignado</h1>
    <p class="lead">Tu cuenta aún no tiene un rol definido.</p>
    <p>Cuando el administrador te asigne uno, podrás acceder a las funciones correspondientes.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-4">Volver al catálogo</a>
</div>
@endsection
