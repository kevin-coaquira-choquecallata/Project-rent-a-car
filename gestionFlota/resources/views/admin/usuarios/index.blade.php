@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Gestión de Usuarios</h1>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Actualizar Rol</th>
                <th>Acciones</th> <!-- NUEVA COLUMNA -->
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->role->nombre ?? 'Sin rol' }}</td>
                    <td>
                        <form action="{{ route('admin.usuarios.actualizar', $usuario) }}" method="POST">
                            @csrf
                            <select name="role_id" class="form-select" onchange="this.form.submit()">
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}" {{ $usuario->role_id == $rol->id ? 'selected' : '' }}>
                                        {{ ucfirst($rol->nombre) }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td>
                        @if(auth()->id() !== $usuario->id)
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
@endsection
