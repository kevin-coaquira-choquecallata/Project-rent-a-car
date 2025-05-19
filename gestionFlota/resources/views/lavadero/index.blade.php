@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Zona Lavadero</h2>

    @if(session('Hecho'))
        <div class="alert alert-success">{{ session('Hecho') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Modelo</th>
                <th>Sucio</th>
                <th>Sin Gasolina</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($vehiculos as $vehiculo)
            <tr>
                <form action="{{ route('lavadero.actualizar', $vehiculo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <td>{{ $vehiculo->matricula }}</td>
                    <td>{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</td>
                    <td>
                        @if($vehiculo->sucio)
                            <input type="checkbox" name="sucio"> Limpiar
                        @else
                            Limpio
                        @endif
                    </td>
                    <td>
                        @if($vehiculo->sin_gasolina)
                            <input type="checkbox" name="sin_gasolina"> Gasolina full
                        @else
                            Full
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm">Enviar</button>
                    </td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
