@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-light p-3 rounded mb-4 border d-flex justify-content-center align-items-center">
            <h1 class="mb-0 fw-bold text-dark display-6 d-flex align-items-center">
                <i class="bi bi-car-front me-2 text-primary"></i>Vehiculos en Taller
            </h1>
        </div>

        <div class="row">
            @forelse($vehiculosMecanico as $vehiculo)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($vehiculo->imagen)
                            <img src="{{ asset('storage/' . $vehiculo->imagen) }}" class="card-img-top object-fit-cover" alt="Imagen vehículo" style="height: 250px;">
                        @else
                            <img src="https://via.placeholder.com/400x200?text=Sin+imagen" class="card-img-top"
                                alt="Sin imagen">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</h5>
                            <p><strong>Matrícula:</strong> {{ $vehiculo->matricula }}</p>
                            <p><strong>Estado:</strong> {{ ucfirst($vehiculo->estado) }}</p>
                            <p><strong>Observaciones:</strong> {{ $vehiculo->observaciones ?? 'Sin observaciones' }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No hay vehículos actualmente en gestión del mecánico.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
