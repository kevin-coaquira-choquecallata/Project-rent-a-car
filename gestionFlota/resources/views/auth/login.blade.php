@extends('layouts.login')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <video autoplay muted loop class="bg-video">
        <source src="{{ asset('storage/spaceLogin.mp4') }}" type="video/mp4">
    </video>

    <div class="login-container">
        <div class="login-box">
            <h3 class="text-center mb-4">Iniciar Sesión</h3>

            @if (session('status'))
                <div class="alert alert-danger">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="form-control" required autofocus />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" required />
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Recordarme</label>
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

                <button type="submit" class="btn btn-yellow w-100">Entrar</button>

                <div class="text-center mt-3">
                    <small>¿No tienes cuenta? <a href="{{ route('register') }}" class="text-warning">Regístrate</a></small>
                </div>
            </form>
        </div>
    </div>
@endsection
