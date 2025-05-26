@extends('layouts.register')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <video autoplay muted loop class="bg-video">
        <source src="{{ asset('storage/spaceLogin.mp4') }}" type="video/mp4">
    </video>

    <div class="register-container">
        <div class="register-box">
            <h3 class="text-center mb-4">Registro</h3>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control" required autofocus />
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="form-control" required />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" required />
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        required />
                </div>

                <button type="submit" class="btn btn-yellow w-100">Registrarse</button>

                <div class="text-center mt-3">
                    <small>¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-warning">Inicia sesión</a></small>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </form>
        </div>
    </div>
@endsection
