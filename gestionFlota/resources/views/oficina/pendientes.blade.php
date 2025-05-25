@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-light p-3 rounded mb-4 border d-flex justify-content-center align-items-center">
            <h1 class="mb-0 fw-bold text-dark display-6 d-flex align-items-center">
                <i class="bi bi-car-front me-2 text-primary"></i>Vehiculos Pendiente de Limpieza o en Taller
            </h1>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Modelo</th>
                    <th>Estado</th>
                    <th>Sucio</th>
                    <th>Sin gasolina</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vehiculosPendientes as $vehiculo)
                    <tr>
                        <td>{{ $vehiculo->matricula }}</td>
                        <td>{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</td>
                        <td>
                            @switch($vehiculo->estado)
                                @case('taller')
                                    <span class="badge bg-danger">Taller</span>
                                @break

                                @case('esperando piezas')
                                    <span class="badge bg-warning text-dark">Esperando piezas</span>
                                @break

                                @default
                                    <span class="badge bg-secondary">{{ ucfirst($vehiculo->estado) }}</span>
                            @endswitch
                        </td>
                        <td>
                            @if ($vehiculo->sucio)
                                <span class="badge bg-warning text-dark">Sí</span>
                            @else
                                <span class="badge bg-success">No</span>
                            @endif
                        </td>
                        <td>
                            @if ($vehiculo->sin_gasolina)
                                <span class="badge bg-warning text-dark">Sí</span>
                            @else
                                <span class="badge bg-success">No</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5">No hay vehículos pendientes.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endsection
