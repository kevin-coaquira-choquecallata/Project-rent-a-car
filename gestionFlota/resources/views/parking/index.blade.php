@extends('layouts.app')

@section('content')
    <div class="container">
        <div
            class="bg-light p-3 rounded mb-4 border d-flex flex-column flex-md-row align-items-center justify-content-between">
            <h1 class="fw-bold text-dark display-6 mb-3 mb-md-0 d-flex align-items-center">
                <i class="bi bi-car-front me-2 text-primary"></i> Parking
            </h1>
            <a href="{{ route('parking.alquilados') }}" class="btn btn-outline-primary">
                <i class="bi bi-box-arrow-in-right me-1"></i> Ver Alquilados
            </a>
        </div>
        <form method="GET" action="{{ route('parking.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="busqueda" class="form-control"
                    placeholder="Buscar por matrícula, modelo o marca" value="{{ request('busqueda') }}">
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </div>
        </form>


        @if ($plazas->isEmpty())
            @if (request('busqueda'))
                <div class="alert alert-warning text-center">
                    No se encontraron vehículos con “<strong>{{ request('busqueda') }}</strong>”.
                </div>
            @else
                <div class="alert alert-info text-center">
                    No hay plazas ocupadas actualmente.
                </div>
            @endif
        @else
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Plaza Nº</th>
                                    <th>Matrícula</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plazas as $plaza)
                                    <tr>
                                        <td>{{ $plaza->numero_plaza }}</td>
                                        @if ($plaza->vehiculo)
                                            <td>{{ $plaza->vehiculo->matricula }}</td>
                                            <td>{{ $plaza->vehiculo->marca }}</td>
                                            <td>{{ $plaza->vehiculo->modelo }}</td>
                                            <td>
                                                @if ($plaza->vehiculo->estado === 'devuelto')
                                                    <form action="{{ route('parking.alquilar', $plaza->vehiculo->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-success btn-sm">
                                                            <i class="bi bi-check-circle me-1"></i> Alquilar
                                                        </button>
                                                    </form>
                                                @else
                                                    {{ ucfirst($plaza->vehiculo->estado) }}
                                                @endif
                                            </td>
                                        @else
                                            <td colspan="4" class="text-muted text-center">Libre</td>
                                        @endif
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
