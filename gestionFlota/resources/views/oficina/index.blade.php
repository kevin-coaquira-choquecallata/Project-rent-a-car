@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-light p-3 rounded mb-4 border d-flex justify-content-center align-items-center">
            <h1 class="mb-0 fw-bold text-dark display-6 d-flex align-items-center">
                <i class="bi bi-car-front me-2 text-primary"></i> Coches devueltos
            </h1>
        </div>

        @if (session('Hecho'))
            <div class="alert alert-success">
                {{ session('Hecho') }}
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevoVehiculo">
                <i class="bi bi-plus-circle me-1"></i> Añadir vehículo
            </button>
        </div>

        {{-- Modal para registrar nuevo vehículo --}}
        <div class="modal fade" id="modalNuevoVehiculo" tabindex="-1" aria-labelledby="modalNuevoVehiculoLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="POST" action="{{ route('oficina.vehiculos.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalNuevoVehiculoLabel">Registrar nuevo vehículo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Matrícula</label>
                                <input type="text" name="matricula" class="form-control" required
                                    pattern="[0-9]{4}[B-DF-HJ-NP-TV-Z]{3}"
                                    title="Formato válido: 4 números seguidos de 3 letras (sin vocales)">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Marca</label>
                                <select name="marca" class="form-select" id="marca" required>
                                    <option value="">Selecciona una marca</option>
                                    <option value="Ford">Ford</option>
                                    <option value="Volkswagen">Volkswagen</option>
                                    <option value="Toyota">Toyota</option>
                                    <option value="Renault">Renault</option>
                                    <option value="Peugeot">Peugeot</option>
                                    <option value="Seat">Seat</option>
                                    <option value="Opel">Opel</option>
                                    <option value="Citroën">Citroën</option>
                                </select>
                                @error('marca')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Modelo</label>
                                <select name="modelo" class="form-select" id="modelo" required>
                                    <option value="">Selecciona un modelo</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Combustible</label>
                                <select name="combustible" class="form-select" required>
                                    <option value="">Selecciona</option>
                                    <option>Gasolina</option>
                                    <option>Diesel</option>
                                    <option>Hibrido</option>
                                    <option>Electrico</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Buscador --}}
        <form method="GET" action="{{ route('oficina.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="busqueda" class="form-control"
                    placeholder="Buscar por matrícula, modelo o marca" value="{{ request('busqueda') }}">
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </div>
        </form>

        {{-- Tabla de vehículos --}}
        @if ($vehiculos->isEmpty())
            @if (request('busqueda'))
                <div class="alert alert-warning text-center">
                    No se encontraron vehículos con “<strong>{{ request('busqueda') }}</strong>”.
                </div>
            @else
                <div class="alert alert-info text-center">
                    No hay vehículos devueltos actualmente.
                </div>
            @endif
        @else
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Matrícula</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Estado</th>
                                    <th>Sucio</th>
                                    <th>Sin gasolina</th>
                                    <th>Observaciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehiculos as $vehiculo)
                                    <tr>
                                        <td>{{ $vehiculo->matricula }}</td>
                                        <td>{{ $vehiculo->marca }}</td>
                                        <td>{{ $vehiculo->modelo }}</td>
                                        <form action="{{ route('oficina.actualizar', $vehiculo->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <td>
                                                <select name="estado" class="form-select form-select-sm">
                                                    <option value="devuelto" {{ $vehiculo->estado == 'devuelto' ? 'selected' : '' }}>Devuelto</option>
                                                    <option value="alquilado" {{ $vehiculo->estado == 'alquilado' ? 'selected' : '' }}>Alquilado</option>
                                                    <option value="taller" {{ $vehiculo->estado == 'taller' ? 'selected' : '' }}>Taller</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="sucio" {{ $vehiculo->sucio ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="sin_gasolina" {{ $vehiculo->sin_gasolina ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <input type="text" name="observaciones" class="form-control form-control-sm"
                                                    value="{{ $vehiculo->observaciones }}" placeholder="Observaciones...">
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-success" type="submit">
                                                        <i class="bi bi-send"></i> Enviar
                                                    </button>
                                        </form>
                                        <form action="{{ route('oficina.vehiculos.destroy', $vehiculo->id) }}" method="POST"
                                              onsubmit="return confirm('¿Estás seguro de que quieres eliminar este vehículo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
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
