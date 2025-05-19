@extends('layouts.guest')

@push('styles')
    <!-- asset te lleva a la carpeta /public -->
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

@section('content')
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="login-card text-center mt-5" style="width: 1000px;">
            <img src="/imagenes/logoCar.jpg" alt="Logo" class="logo rounded-circle"
                style="width: 190px; height: 190px; object-fit: cover;">
            <h4 class="text-success mb-3">REGISTRARSE</h4>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3 text-start">
                    <label for="name" class="form-label">Nombre</label>
                    <input id="name" type="text" name="name" class="form-control" required autofocus>
                </div>
                <div class="mb-3 text-start">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input id="email" type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                        required>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-success">REGISTRARSE</button>
                </div>
                <div class="mb-2">
                    <hr>
                    <span>OR</span>
                </div>
                <a href="{{ route('login') }}" class="btn btn-primary w-100">YA TENGO CUENTA</a>
            </form>
        </div>
    </div>

    <div class="footer-notes text-center">
        <strong>NOTAS:</strong><br>
        - Ingresa tus datos para registrarte.<br>
        - La contraseña debe ser segura.<br>
        - No compartas tu información con terceros.
    </div>
    <footer class="text-center text-white py-2" style="background-color: #61a603;">
        &copy; {{ date('Y') }} Gestión de Flota. Todos los derechos reservados.
    </footer>
@endsection
