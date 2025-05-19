@extends('layouts.app')
@push('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="login-card text-center mt-5" style="width: 1000px;">
            <img src="/imagenes/logoCar.jpg" alt="Logo" class="logo rounded-circle"
                style="width: 190px; height: 190px; object-fit: cover;">

        <h4 class="text-primary mb-3">CUSTOMER PORTAL | LOGIN</h4>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3 form-check text-start">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">LOGIN</button>
            </div>

            <div class="mb-2">
                <hr>
                <span>OR</span>
            </div>

            <a href="{{ route('register') }}" class="btn btn-success w-100">REGISTER</a>
        </form>
    </div>
</div>

<div class="footer-notes text-center">
    <strong>NOTES:</strong><br>
    - Enter your email and password to start your session.<br>
    - Do not share your credentials.<br>
    - Unauthorized access is prohibited.
</div>

<footer class="text-center text-white py-2" style="background-color: #61a60e;">
    &copy; {{ date('Y') }} Gestión de Flota. All rights reserved.
</footer>
@endsection
