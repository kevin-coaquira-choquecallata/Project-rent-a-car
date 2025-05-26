@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Catálogo de Vehículos</h1>
    <div class="row">
        @foreach($vehiculos as $vehiculo)
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($vehiculo->imagen)
                        <img src="{{ asset('storage/' . $vehiculo->imagen) }}" class="card-img-top object-fit-cover" alt="vehiculo" style="height: 200px;">
                    @else
                        <img src="https://via.placeholder.com/400x200?text=Sin+imagen" class="card-img-top" alt="placeholder">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</h5>
                        <p class="card-text">Combustible: {{ $vehiculo->combustible }}</p>
                        <p class="card-text">Matrícula: {{ $vehiculo->matricula }}</p>
                        <span class="badge bg-info text-dark">Estado: {{ ucfirst($vehiculo->estado) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
