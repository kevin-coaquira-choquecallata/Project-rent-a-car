@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bg-light p-3 rounded mb-4 border text-center">
        <h1 class="fw-bold text-dark display-6">
            <i class="bi bi-clock-history text-primary me-2"></i> Historial de Movimientos
        </h1>
    </div>

    @if($historial->isEmpty())
        <div class="alert alert-info text-center">No hay movimientos registrados.</div>
    @else
        <table class="table table-striped">
            <thead class="table-light">
                <tr>
                    <th>Fecha</th>
                    <th>Matrícula</th>
                    <th>Movimiento</th>
                    <th>Usuario</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historial as $movimiento)
                    <tr>
                        <td>{{ $movimiento->fecha->format('d/m/Y H:i') }}</td>
                        <td>{{ $movimiento->vehiculo->matricula ?? 'N/A' }}</td>
                        <td>{{ $movimiento->accion }}</td>
                        <td>{{ $movimiento->usuario->name ?? 'Usuario eliminado' }}</td>
                        <td>{!! $movimiento->observaciones !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
