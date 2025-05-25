@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bg-light p-3 rounded mb-4 border d-flex justify-content-center align-items-center">
        <h1 class="mb-0 fw-bold text-dark display-6 d-flex align-items-center">
            <i class="bi bi-car-front me-2 text-primary"></i>Vehículos Alquilados
        </h1>
    </div>

    @if (session('Hecho'))
        <div class="alert alert-success">{{ session('Hecho') }}</div>
    @endif

    @if ($vehiculos->isEmpty())
        <div class="alert alert-info text-center">No hay vehículos alquilados actualmente.</div>
    @else
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
    @endif
</div>
@endsection
