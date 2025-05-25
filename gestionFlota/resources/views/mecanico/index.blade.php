@extends('layouts.app')

@section('content')
    <div class="container">
                <div class="bg-light p-3 rounded mb-4 border d-flex justify-content-center align-items-center">
            <h1 class="mb-0 fw-bold text-dark display-6 d-flex align-items-center">
                <i class="bi bi-car-front me-2 text-primary"></i>Vehiculos en Taller
            </h1>
        </div>
        <form method="GET" action="{{ route('mecanico.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="busqueda" class="form-control" placeholder="Buscar por matrícula, modelo o marca"
                    value="{{ request('busqueda') }}">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </form>


        @if (session('Hecho'))
            <div class="alert alert-success">
                {{ session('Hecho') }}
            </div>
        @endif

        <div class="row">
            @forelse($vehiculosEnTaller as $vehiculo)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($vehiculo->imagen)
                            <img src="{{ asset('storage/' . $vehiculo->imagen) }}" class="card-img-top object-fit-cover" alt="Imagen vehiculo" style="height: 250px;">
                        @else
                            <img src="https://via.placeholder.com/400x200?text=Sin+imagen" class="card-img-top"
                                alt="Sin imagen">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</h5>
                            <p><strong>Matrícula:</strong> {{ $vehiculo->matricula }}</p>
                            <p><strong>Estado actual:</strong> {{ ucfirst($vehiculo->estado) }}</p>

                            <form method="POST" action="{{ route('mecanico.actualizar', $vehiculo->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-2">
                                    <label class="form-label">Cambiar estado:</label>
                                    <select name="estado" class="form-select">
                                        <option value="taller" {{ $vehiculo->estado === 'taller' ? 'selected' : '' }}>Taller
                                        </option>
                                        <option value="esperando piezas"
                                            {{ $vehiculo->estado === 'esperando piezas' ? 'selected' : '' }}>Esperando
                                            piezas</option>
                                        <option value="reparado">Reparado</option>
                                    </select>
                                </div>

                                <div class="mb-2">
                                    <label class="form-label">Observaciones:</label>
                                    <textarea name="observaciones" class="form-control" rows="2">{{ $vehiculo->observaciones }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No hay vehículos en taller actualmente.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
