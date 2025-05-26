@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bg-light p-3 rounded mb-4 border text-center">
        <h1 class="fw-bold text-dark display-6">
            <i class="bi bi-exclamation-triangle text-warning me-2"></i> Vehículos listos sin plaza asignada
        </h1>
    </div>

    <form method="GET" action="{{ route('oficina.sinplaza') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="busqueda" class="form-control" placeholder="Buscar por matrícula, modelo o marca"
                value="{{ request('busqueda') }}">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
        </div>
    </form>

    @if ($vehiculosListosSinPlaza->isEmpty())
        <div class="alert alert-{{ request('busqueda') ? 'warning' : 'info' }} text-center">
            {{ request('busqueda')
                ? 'No se encontraron vehículos con “' . request('busqueda') . '”.'
                : 'No hay vehículos esperando plaza en este momento.' }}
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Matrícula</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Estado</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiculosListosSinPlaza as $vehiculo)
                                <tr>
                                    <td>{{ $vehiculo->matricula }}</td>
                                    <td>{{ $vehiculo->marca }}</td>
                                    <td>{{ $vehiculo->modelo }}</td>
                                    <td>{{ $vehiculo->estado === 'devuelto' ? 'Listo' : ucfirst($vehiculo->estado) }}</td>
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
