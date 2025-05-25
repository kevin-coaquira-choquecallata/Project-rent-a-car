@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-light p-3 rounded mb-4 border d-flex justify-content-center align-items-center">
            <h1 class="mb-0 fw-bold text-dark display-6 d-flex align-items-center">
                <i class="bi bi-car-front me-2 text-primary"></i>Lavadero
            </h1>
        </div>

        @if (session('Hecho'))
            <div class="alert alert-success">{{ session('Hecho') }}</div>
        @endif

        @if ($plazasLibres->isEmpty())
            <div class="alert alert-danger text-center">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                No hay plazas disponibles en el parking. Espera a que se liberen antes de asignar más vehículos.
            </div>
        @endif

        @if ($vehiculos->isEmpty())
            <div class="alert alert-info">No hay vehículos pendientes de limpiar o repostar.</div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Modelo</th>
                        <th>Sucio</th>
                        <th>Sin Gasolina</th>
                        <th>Asignar Plaza</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehiculos as $vehiculo)
                        <tr @if($vehiculo->listo_entrega && !$vehiculo->parking) class="table-warning" @endif>
                            <form action="{{ route('lavadero.actualizar', $vehiculo->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td>{{ $vehiculo->matricula }}</td>
                                <td>{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</td>
                                <td>
                                    @if ($vehiculo->sucio)
                                        <input type="checkbox" name="sucio"> Limpiar
                                    @else
                                        Limpio
                                    @endif
                                </td>
                                <td>
                                    @if ($vehiculo->sin_gasolina)
                                        <input type="checkbox" name="sin_gasolina"> Gasolina full
                                    @else
                                        Full
                                    @endif
                                </td>
                                <td>
                                    @if ($plazasLibres->isEmpty())
                                        <span class="text-danger">Sin plazas</span>
                                    @else
                                        <select name="plaza_id" class="form-select">
                                            <option value="">-- Sin asignar --</option>
                                            @foreach ($plazasLibres as $plaza)
                                                <option value="{{ $plaza->id }}">Plaza {{ $plaza->numero_plaza }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                </td>
                                <td>{{ $vehiculo->observaciones ?? '—' }}</td>
                                <td>
                                    <button class="btn btn-success btn-sm">Enviar</button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
