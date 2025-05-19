@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="mb-3">🔧 Área del Mecánico</h1>
    <p>Aquí se registran vehículos en reparación y se actualiza su estado.</p>
    <a href="{{ url('/') }}" class="btn btn-outline-secondary mt-3">Volver al catálogo</a>
</div>
@endsection
