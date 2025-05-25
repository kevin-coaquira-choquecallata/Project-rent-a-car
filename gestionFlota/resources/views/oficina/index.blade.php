@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-light p-3 rounded mb-4 border d-flex justify-content-center align-items-center">
            <h1 class="mb-0 fw-bold text-dark display-6 d-flex align-items-center">
                <i class="bi bi-car-front me-2 text-primary"></i>Coches devueltos
            </h1>
        </div>
        @if (session('Hecho'))
            <div class="alert alert-success">
                {{ session('Hecho') }}
            </div>
        @endif

        <form method="GET" action="{{ route('oficina.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="busqueda" class="form-control" placeholder="Buscar por matrícula, modelo o marca"
                    value="{{ request('busqueda') }}">
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </div>
        </form>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Matrícula</th>
                            <th>Modelo</th>
                            <th>Estado</th>
                            <th>Sucio</th>
                            <th>Sin gasolina</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehiculos as $vehiculo)
                            <tr>
                                <form action="{{ route('oficina.actualizar', $vehiculo->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <td>{{ $vehiculo->matricula }}</td>
                                    <td>{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</td>
                                    <td>
                                        <select name="estado" class="form-select form-select-sm">
                                            <option value="devuelto"
                                                {{ $vehiculo->estado == 'devuelto' ? 'selected' : '' }}>Devuelto</option>
                                            <option value="alquilado"
                                                {{ $vehiculo->estado == 'alquilado' ? 'selected' : '' }}>Alquilado</option>
                                            <option value="taller" {{ $vehiculo->estado == 'taller' ? 'selected' : '' }}>
                                                Taller</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="sucio" {{ $vehiculo->sucio ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="sin_gasolina"
                                            {{ $vehiculo->sin_gasolina ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <input type="text" name="observaciones" class="form-control form-control-sm"
                                            placeholder="Observaciones..." value="{{ $vehiculo->observaciones }}">
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-success" type="submit">
                                            <i class="bi bi-send"></i> Enviar
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No se encontraron vehículos.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
