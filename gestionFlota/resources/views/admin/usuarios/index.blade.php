@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bg-light p-3 rounded mb-4 border text-center">
        <h1 class="fw-bold text-dark display-6">
            <i class="bi bi-people text-primary me-2"></i> Gestión de Usuarios
        </h1>
    </div>

    {{-- Formulario de búsqueda --}}
    <form method="GET" action="{{ route('admin.usuarios') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="busqueda" class="form-control" placeholder="Buscar por nombre o email"
                value="{{ request('busqueda') }}">
            <button class="btn btn-outline-primary" type="submit">Buscar</button>
        </div>
    </form>

    @if (session('status'))
        <div class="alert alert-success text-center">{{ session('status') }}</div>
    @endif

    @if ($usuarios->isEmpty())
        <div class="alert alert-{{ request('busqueda') ? 'warning' : 'info' }} text-center">
            {{ request('busqueda')
                ? 'No se encontraron usuarios con “' . request('busqueda') . '”.'
                : 'No hay usuarios registrados actualmente.' }}
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol actual</th>
                                <th>Asignar nuevo rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->role->nombre ?? 'Sin rol' }}</td>
                                    <td>
                                        @if ($usuario->email === 'kevin.choquecallata')
                                            <span class="text-muted">Admin fijo</span>
                                        @else
                                            <form action="{{ route('admin.usuarios.actualizar', $usuario) }}" method="POST" class="d-flex">
                                                @csrf
                                                <select name="role_id" class="form-select form-select-sm me-2">
                                                    <option value="">-- Seleccionar rol --</option>
                                                    @foreach ($roles as $rol)
                                                        <option value="{{ $rol->id }}" {{ $usuario->role_id == $rol->id ? 'selected' : '' }}>
                                                            {{ ucfirst($rol->nombre) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button class="btn btn-sm btn-primary" type="submit">Actualizar</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($usuario->email === 'kevin.choquecallata')
                                            <span class="text-muted">No editable</span>
                                        @elseif (auth()->id() !== $usuario->id)
                                            <form action="{{ route('admin.usuarios.eliminar', $usuario) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>
                                        @else
                                            <span class="text-muted">Tú</span>
                                        @endif
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
