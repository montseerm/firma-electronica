<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión | Firma Judicial</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@php
    $lockoutSeconds = session('lockout_seconds');
@endphp

<body class="min-h-screen bg-[#eef4f5] flex items-center justify-center px-4 py-10 style="font-bold: Arial, Helvetica, sans-serif;>

    <main class="w-full max-w-[460px]">

        <!-- Caja principal del login -->
        <section class="bg-white border border-gray-200 shadow-xl px-8 py-10 sm:px-10">

            <!-- Encabezado -->
            <header class="text-center mb-8">
                <div class="mx-auto mb-5 flex items-center justify-center">
                    <img
                        src="{{ asset('img/logo-firmajudicial.png') }}"
                        alt="Logo Firma Judicial"
                        class="h-14 object-contain"
                        onerror="this.style.display='none'"
                    >
                </div>

                <h1 class="text-2xl sm:text-3xl font-semibold text-[#00345c]">
                    Inicio de sesión
                </h1>
            </header>

            <!-- Mensaje de sesión -->
            @if (session('status'))
                <div class="mb-5 border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Errores -->
            @if ($errors->any())
                <div class="mb-5 border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Correo -->
                <div>
                    <label for="email" class="block mb-2 text-sm font-bold text-[#00345c]">
                        Correo electrónico
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="ejemplo@pjcdmx.gob.mx"
                        @disabled($lockoutSeconds)
                        class="block w-full border border-gray-300 bg-white px-5 py-4 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#00857d] focus:ring-2 focus:ring-[#00857d]/30 disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed"
                    >
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block mb-2 text-sm font-bold text-[#00345c]">
                        Contraseña
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Ingresa tu contraseña"
                        @disabled($lockoutSeconds)
                        class="block w-full border border-gray-300 bg-white px-5 py-4 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#00857d] focus:ring-2 focus:ring-[#00857d]/30 disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed"
                    >
                </div>

                <!-- Recuperar contraseña -->
                @if (Route::has('password.request'))
                    <div class="text-right">
                        <a href="{{ route('password.request') }}" class="text-sm font-bold text-[#00857d] hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                @endif

                <!-- Boton iniciar sesion -->
                <button
                    type="submit"
                    id="btnLogin"
                    @disabled($lockoutSeconds)
                    class="w-full bg-[#00857d] py-4 text-white font-semibold shadow-lg shadow-[#00857d]/20 transition hover:bg-[#006f69] active:scale-[0.99] disabled:bg-gray-400 disabled:shadow-none disabled:cursor-not-allowed"
                >
                    Iniciar Sesión
                </button>

                <!-- Crear cuenta -->
                @if (Route::has('register'))
                    <div class="text-center pt-1">
                        <a href="{{ route('register') }}" class="text-sm font-bold text-[#00345c] hover:text-[#00857d]">
                            Crear cuenta nueva
                        </a>
                    </div>
                @endif
            </form>

        </section>

        <p class="text-center text-xs text-gray-400 mt-5">
            Poder Judicial de la Ciudad de México · Firma Digital
        </p>

    </main>

    <!-- Modal de bloqueo -->
    @if($lockoutSeconds)
        <div
            id="modalBloqueo"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4"
            data-lockout-seconds="{{ $lockoutSeconds }}"
        >
            <section class="w-full max-w-[430px] bg-white border border-gray-300 shadow-2xl">

                <!-- Encabezado verde -->
                <div class="px-6 pt-6">
                    <div class="bg-[#00857d] h-12 flex items-center justify-center text-center">
                        <span class="text-white font-bold text-base leading-none">
                            Acceso bloqueado temporalmente
                        </span>
                    </div>
                </div>

                <!-- Contenido principal -->
                <div class="px-6 py-6">

                    <div class="text-center mb-5">

                        </div>

                        <h2 class="text-xl font-extrabold text-center text-[#00345c]">
                            Intentos excedidos
                        </h2>

                        <p class="mt-3 text-sm leading-relaxed text-gray-600 max-w-sm mx-auto">
                            Has superado el número máximo de intentos permitidos.
                        
                        </p>
                    </div>

                    <!-- Contador -->
                    <div class="border border-gray-300 bg-[#f8fafb] px-5 py-4 text-center mb-5">
                        <p class="text-xs text-gray-600 mb-1">
                            Podrás intentar nuevamente en:
                        </p>

                        <p class="text-4xl font-semibold text-[#00857d]">
                            <span id="contadorBloqueo">{{ $lockoutSeconds }}</span>
                        </p> 
                    </div>

                    <!-- Enlaces del modal -->
                    <div class="flex items-center justify-center gap-5 flex-wrap mb-5">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-bold text-[#00857d] hover:underline">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-bold text-[#00345c] hover:underline">
                                Crear cuenta nueva
                            </a>
                        @endif
                    </div>

                </div>

            </section>
        </div>
    @endif

</body>
</html>