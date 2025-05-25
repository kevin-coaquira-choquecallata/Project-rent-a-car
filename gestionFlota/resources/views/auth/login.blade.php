@extends('layouts.login')

@section('content')
<style>

    .bg-video {
        position: fixed;
        top: 0;
        left: 0;
        min-width: 100%;
        min-height: 100%;
        object-fit: cover;
        z-index: -1;
    }
    .login-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .login-box {
        background-color: rgba(0, 0, 0, 0.75);
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0,0,0,0.8);
        color: #fff;
        width: 100%;
        max-width: 400px;
    }
    .btn-yellow {
        background-color: #ffc107;
        border: none;
        font-weight: bold;
    }
</style>

<video autoplay muted loop class="bg-video">
    <source src="{{ asset('storage/spaceLogin.mp4') }}" type="video/mp4">
    Tu navegador no soporta videos HTML5.
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

            <button type="submit" class="btn btn-yellow w-100">Entrar</button>

            <div class="text-center mt-3">
                <small>¿No tienes cuenta? <a href="{{ route('register') }}" class="text-warning">Regístrate</a></small>
            </div>
        </form>
    </div>
</div>
@endsection
