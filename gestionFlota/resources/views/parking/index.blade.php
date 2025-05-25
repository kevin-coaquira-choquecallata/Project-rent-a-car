@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-light p-3 rounded mb-4 border d-flex justify-content-center align-items-center">
            <h1 class="mb-0 fw-bold text-dark display-6 d-flex align-items-center">
                <i class="bi bi-car-front me-2 text-primary"></i>Parking
            </h1>
            <a href="{{ route('parking.alquilados') }}" class="btn btn-outline-primary ms-auto">
                <i class="bi bi-box-arrow-in-right me-1"></i> Ver Alquilados
            </a>

        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Plaza Nº</th>
                            <th>Matrícula</th>
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
                                    <td>{{ $plaza->vehiculo->marca }} {{ $plaza->vehiculo->modelo }}</td>
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
                                    <td colspan="3" class="text-muted">Libre</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
