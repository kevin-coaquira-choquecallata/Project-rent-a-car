@extends('layouts.register')

@section('content')
<style>
    body, html {
        height: 100%;
        margin: 0;
        overflow: hidden;
    }
    .bg-video {
        position: fixed;
        top: 0;
        left: 0;
        min-width: 100%;
        min-height: 100%;
        object-fit: cover;
        z-index: -1;
    }
    .register-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .register-box {
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
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required />
            </div>

            <button type="submit" class="btn btn-yellow w-100">Registrarse</button>

            <div class="text-center mt-3">
                <small>¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-warning">Inicia sesión</a></small>
            </div>
        </form>
    </div>
</div>
@endsection
