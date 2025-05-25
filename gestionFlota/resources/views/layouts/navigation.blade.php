<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">Gestión Flota</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegación">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @auth
                    <!--<li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Inicio</a>
                    </li>-->
                    @if (Auth::user()->role && Auth::user()->role->nombre === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.usuarios') }}">Admin</a>
                        </li>
                    @endif
                    @if ((Auth::user()->role && Auth::user()->role->nombre === 'oficina') || Auth::user()->role->nombre === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('oficina.mecanico') }}">Vehículos en taller</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('oficina.pendientes') }}">Pendientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('parking.index') }}">Parking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('historial.index') }}">
                                <i class="bi bi-clock-history me-1"></i> Historial
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('oficina.sinplaza') }}">
                                <i class="bi bi-box-arrow-in-down me-1"></i> Listos sin plaza
                            </a>
                        </li>
                    @endif
                @endauth
                <!--<li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Catálogo</a>
                </li>-->
            </ul>

            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
