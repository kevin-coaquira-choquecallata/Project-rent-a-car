@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-light p-3 rounded mb-4 border d-flex justify-content-center align-items-center">
            <h1 class="mb-0 fw-bold text-dark display-6 d-flex align-items-center">
                <i class="bi bi-car-front me-2 text-primary"></i> Vehículos Alquilados
            </h1>
        </div>
        <form method="GET" action="{{ route('parking.alquilados') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="busqueda" class="form-control" placeholder="Buscar por matrícula, modelo o marca"
                    value="{{ request('busqueda') }}">
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </div>
        </form>
        @if (session('Hecho'))
            <div class="alert alert-success">{{ session('Hecho') }}</div>
        @endif

        @if ($vehiculos->isEmpty())
            @if (request('busqueda'))
                <div class="alert alert-warning text-center">
                    No se encontraron vehículos con “<strong>{{ request('busqueda') }}</strong>”.
                </div>
            @else
                <div class="alert alert-info text-center">No hay vehículos alquilados actualmente.</div>
            @endif
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Matrícula</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehiculos as $vehiculo)
                            <tr>
                                <td>{{ $vehiculo->matricula }}</td>
                                <td>{{ $vehiculo->marca }}</td>
                                <td>{{ $vehiculo->modelo }}</td>
                                <td>{{ ucfirst($vehiculo->estado) }}</td>
                                <td>
                                    <form action="{{ route('parking.devolucion', $vehiculo->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-warning btn-sm">
                                            <i class="bi bi-arrow-90deg-left me-1"></i> Marcar como Devuelto
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
