<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Firma Judicial') }}</title>

    <!-- Fuente -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- CSS y JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        <!-- Encabezado institucional -->
        <header class="fj-header">
            <div class="fj-header-container">
                <div class="fj-header-grid">

                    <!-- Logo -->
                    <div class="flex justify-start">
                        <img
                            src="{{ asset('img/logo-firmajudicial.png') }}"
                            alt="Logo Poder Judicial"
                            class="fj-logo"
                        >
                    </div>

                    <!-- Título -->
                    <div>
                        <h1 class="fj-title">
                            Firma Digital
                        </h1>
                    </div>

                    <!-- Espacio derecho -->
                    <div></div>
                </div>

                <div class="fj-line"></div>
            </div>
        </header>

        <!-- Barra de navegación -->
        @include('layouts.navigation')

        <!-- Contenido -->
        <main>
            {{ $slot }}
        </main>

    </div>
</body>
</html>