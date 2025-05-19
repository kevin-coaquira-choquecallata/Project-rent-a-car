@extends('layouts.app')
@if(session('Hecho'))
    <div class="alert alert-success">
        {{session('Hecho')}}
    </div>
@endif

@section('content')
<div class="container">
    <h2>Coches devueltos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Modelo</th>
                <th>Estado</th>
                <th>Sucio</th>
                <th>Sin gasolina</th>
                <th>Enviar a taller</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($vehiculos as $vehiculo)
            <tr>
                <form action="{{ route('oficina.actualizar', $vehiculo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <td>{{ $vehiculo->matricula }}</td>
                    <td>{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</td>
                    <td>
                        <select name="estado" class="form-select">
                            <option value="devuelto" {{ $vehiculo->estado == 'devuelto' ? 'selected' : '' }}>Devuelto</option>
                            <option value="alquilado" {{ $vehiculo->estado == 'alquilado' ? 'selected' : '' }}>Alquilado</option>
                        </select>
                    </td>
                    <td><input type="checkbox" name="sucio" {{ $vehiculo->sucio ? 'checked' : '' }}></td>
                    <td><input type="checkbox" name="sin_gasolina" {{ $vehiculo->sin_gasolina ? 'checked' : '' }}></td>
                    <td><input type="checkbox" name="en_taller" {{ $vehiculo->en_taller ? 'checked' : '' }}></td>
                    <td><button class="btn btn-primary btn-sm" type="submit">Enviar</button></td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection