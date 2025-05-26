@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bg-light p-3 rounded mb-4 border d-flex justify-content-center align-items-center">
        <h1 class="mb-0 fw-bold text-dark display-6 d-flex align-items-center">
            <i class="bi bi-bucket me-2 text-primary"></i> Vehículos pendientes (visual)
        </h1>
    </div>

    <form method="GET" action="{{ route('oficina.pendientes') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="busqueda" class="form-control" placeholder="Buscar por matrícula, modelo o marca"
                value="{{ request('busqueda') }}">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
        </div>
    </form>

    @if ($vehiculos->isEmpty())
        <div class="alert alert-{{ request('busqueda') ? 'warning' : 'info' }} text-center">
            {{ request('busqueda')
                ? 'No se encontraron vehículos con “' . request('busqueda') . '”.'
                : 'No hay vehículos pendientes de limpiar o repostar.'
            }}
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Matrícula</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Sucio</th>
                                <th>Sin gasolina</th>
                                <th>Plaza asignada</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiculos as $vehiculo)
                                <tr>
                                    <td>{{ $vehiculo->matricula }}</td>
                                    <td>{{ $vehiculo->marca }}</td>
                                    <td>{{ $vehiculo->modelo }}</td>
                                    <td class="text-center">
                                        {{ $vehiculo->sucio ? 'Sí' : 'No' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $vehiculo->sin_gasolina ? 'Sí' : 'No' }}
                                    </td>
                                    <td>
                                        {{ $vehiculo->parking ? 'Plaza #' . $vehiculo->parking->numero_plaza : '—' }}
                                    </td>
                                    <td>{{ $vehiculo->observaciones ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
