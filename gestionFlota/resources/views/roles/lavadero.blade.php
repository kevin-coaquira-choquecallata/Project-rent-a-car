@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="mb-3">🧼 Área del Lavadero</h1>
    <p>Aquí podrás marcar los vehículos como limpios o sucios.</p>
    <a href="{{ url('/') }}" class="btn btn-outline-secondary mt-3">Volver al catálogo</a>
</div>
@endsection
