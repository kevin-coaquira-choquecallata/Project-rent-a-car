@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bg-light p-3 rounded mb-4 border d-flex justify-content-center align-items-center">
        <h1 class="mb-0 fw-bold text-dark display-6 d-flex align-items-center">
            <i class="bi bi-tools me-2 text-primary"></i> Vehículos en Taller
        </h1>
    </div>

    <form method="GET" action="{{ route('mecanico.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="busqueda" class="form-control" placeholder="Buscar por matrícula, modelo o marca"
                value="{{ request('busqueda') }}">
            <button class="btn btn-outline-primary" type="submit">Buscar</button>
        </div>
    </form>

    @if (session('Hecho'))
        <div class="alert alert-success">{{ session('Hecho') }}</div>
    @endif

    @if ($vehiculosMecanico->isEmpty())
        @if (request('busqueda'))
            <div class="alert alert-warning text-center">
                No se encontraron vehículos con “<strong>{{ request('busqueda') }}</strong>”.
            </div>
        @else
            <div class="alert alert-info text-center">
                No hay vehículos actualmente en gestión del mecánico.
            </div>
        @endif
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
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiculosMecanico as $vehiculo)
                                <tr>
                                    <form method="POST" action="{{ route('mecanico.actualizar', $vehiculo->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <td>{{ $vehiculo->matricula }}</td>
                                        <td>{{ $vehiculo->marca }}</td>
                                        <td>{{ $vehiculo->modelo }}</td>
                                        <td>
                                            <select name="estado" class="form-select form-select-sm">
                                                <option value="taller" {{ $vehiculo->estado === 'taller' ? 'selected' : '' }}>Taller</option>
                                                <option value="esperando piezas" {{ $vehiculo->estado === 'esperando piezas' ? 'selected' : '' }}>Esperando piezas</option>
                                                <option value="reparado" {{ $vehiculo->estado === 'reparado' ? 'selected' : '' }}>Reparado</option>
                                            </select>
                                        </td>
                                        <td>
                                            <textarea name="observaciones" class="form-control form-control-sm" rows="1">{{ $vehiculo->observaciones }}</textarea>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                                        </td>
                                    </form>
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
