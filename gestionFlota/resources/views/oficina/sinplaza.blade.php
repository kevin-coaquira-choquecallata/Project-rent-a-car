@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bg-light p-3 rounded mb-4 border text-center">
        <h1 class="fw-bold text-dark display-6">
            <i class="bi bi-exclamation-triangle text-warning me-2"></i> Vehículos listos sin plaza asignada
        </h1>
    </div>

    @if ($vehiculosListosSinPlaza->isEmpty())
        <div class="alert alert-info text-center">
            No hay vehículos esperando plaza en este momento.
        </div>
    @else
        <table class="table table-striped">
            <thead class="table-light">
                <tr>
                    <th>Matrícula</th>
                    <th>Modelo</th>
                    <th>Estado</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehiculosListosSinPlaza as $vehiculo)
                    <tr>
                        <td>{{ $vehiculo->matricula }}</td>
                        <td>{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</td>
                        <td>{{ $vehiculo->estado === 'devuelto' ? 'Listo':ucfirst($vehiculo->estado) }}</td>
                        <td>{{ $vehiculo->observaciones ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
