@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="mb-3">📋 Área de Oficina</h1>
    <p>Desde aquí puedes gestionar reservas, asignaciones y vehículos disponibles.</p>
    <a href="{{ url('/') }}" class="btn btn-outline-secondary mt-3">Volver al catálogo</a>
</div>
@endsection
