<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--Css-->
    @stack('styles')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modelosPorMarca = {
                "Ford": ["Fiesta", "Focus", "Kuga"],
                "Volkswagen": ["Golf", "Polo", "Passat"],
                "Toyota": ["Corolla", "Yaris", "RAV4"],
                "Renault": ["Clio", "Captur", "Megane"],
                "Peugeot": ["208", "308", "3008"],
                "Seat": ["Ibiza", "León", "Ateca"],
                "Opel": ["Corsa", "Astra", "Mokka"],
                "Citroën": ["C3", "C4", "C5 Aircross"]
            };

            const marcaSelect = document.getElementById('marca');
            const modeloSelect = document.getElementById('modelo');

            if (marcaSelect && modeloSelect) {
                marcaSelect.addEventListener('change', function() {
                    const marcaSeleccionada = this.value;
                    modeloSelect.innerHTML = '<option value="">Selecciona un modelo</option>';

                    if (modelosPorMarca[marcaSeleccionada]) {
                        modelosPorMarca[marcaSeleccionada].forEach(function(modelo) {
                            const option = document.createElement('option');
                            option.value = modelo;
                            option.textContent = modelo;
                            modeloSelect.appendChild(option);
                        });
                    }
                });
            }
        });
    </script>
</body>

</html>
