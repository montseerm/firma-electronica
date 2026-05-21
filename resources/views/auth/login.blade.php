@php
    use Illuminate\Support\Facades\RateLimiter;
    use Illuminate\Support\Str;

    $correoIngresado = old('email');

    $bloqueoKey = $correoIngresado
        ? Str::transliterate(Str::lower($correoIngresado).'|'.request()->ip())
        : null;

    $bloqueado = $bloqueoKey
        ? RateLimiter::tooManyAttempts($bloqueoKey, 3)
        : false;

    $bloqueoSegundos = $bloqueado
        ? RateLimiter::availableIn($bloqueoKey)
        : 0;
@endphp


<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión | Firma Judicial</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@php
    /*
        Esta variable controla si aparece el modal.

        Si en tu controlador estás mandando:
        return back()->with('bloqueo_login', true)->with('lockout_seconds', 30);

        Entonces el modal aparecerá durante 30 segundos.
    */
    $bloqueoLogin = session('bloqueo_login', false);
    $segundosBloqueo = session('lockout_seconds', 30);
@endphp

<body class="min-h-screen bg-[#eef4f5] flex items-center justify-center px-4 py-10">

    <main class="w-full max-w-[460px]">

        <section class="bg-white shadow-xl border border-gray-200 px-8 py-10 sm:px-10">

            <!-- Logo -->
            <header class="text-center mb-8">
                <img
                    src="{{ asset('img/logo-firmajudicial.png') }}"
                    alt="Logo Firma Judicial"
                    class="mx-auto mb-6 h-16 object-contain"
                >

                <h1 class="text-3xl font-medium">
                    Inicio de sesión
                </h1>

                <p class="mt-3 text-sm text-gray-500">
                    Ingresa tus credenciales para acceder al sistema
                </p>
            </header>

            <!-- Mensaje de estado -->
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
                    <label for="email" class="block mb-2 text-sm font-medium text-[#00345c]">
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
                        @if($bloqueoLogin) disabled @endif
                        class="block w-full border border-gray-300 bg-white px-5 py-4 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#00857d] focus:ring-2 focus:ring-[#00857d]/30 disabled:bg-gray-100 disabled:text-gray-400"
                    >
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-[#00345c]">
                        Contraseña
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Ingresa tu contraseña"
                        @if($bloqueoLogin) disabled @endif
                        class="block w-full border border-gray-300 bg-white px-5 py-4 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#00857d] focus:ring-2 focus:ring-[#00857d]/30 disabled:bg-gray-100 disabled:text-gray-400"
                    >
                </div>

                <!-- Recuperar contraseña -->
                @if (Route::has('password.request'))
                    <div class="text-right">
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-[#00857d] hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                @endif

                <!-- Botón login -->
                <button
                    id="btnLogin"
                    type="submit"
                    @if($bloqueoLogin) disabled @endif
                    class="w-full bg-[#00857d] py-4 text-white font-semibold shadow-lg shadow-[#00857d]/20 transition hover:bg-[#006f69] active:scale-[0.99] disabled:bg-gray-500 disabled:cursor-not-allowed disabled:shadow-none"
                >
                    Iniciar Sesión
                </button>

                <!-- Crear cuenta -->
                @if (Route::has('register'))
                    <div class="text-center pt-1">
                        <a href="{{ route('register') }}" class="text-sm font-medium text-[#00345c] hover:text-[#00857d]">
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

    @if ($bloqueoSegundos > 0)
    <div
        id="modalBloqueo"
        data-lockout-seconds="{{ $bloqueoSegundos }}"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4"
    >
        <div class="w-full max-w-[430px] bg-white shadow-2xl border border-gray-300">

            <div class="mx-6 mt-6 bg-[#00857d] text-white text-center py-3 font-extrabold text-base">
                Acceso bloqueado temporalmente
            </div>

            <div class="px-7 py-7 text-center">
                <h2 class="text-2xl font-extrabold text-[#00345c] mb-3">
                    Intentos excedidos
                </h2>

                <p class="text-sm text-gray-600 leading-6">
                    Has superado el número máximo de intentos permitidos.
                    Por seguridad, el sistema bloqueó temporalmente el inicio de sesión.
                </p>
            </div>

            <div class="border-y border-gray-300 bg-[#f6f9fa] px-6 py-5 text-center">
                <p class="text-xs text-gray-600 mb-2">
                    Podrás intentar nuevamente en:
                </p>

                <p class="text-4xl font-extrabold text-[#00857d]">
                    <span id="contadorBloqueo">{{ $bloqueoSegundos }}</span>s
                </p>
            </div>
        </div>
    </div>
@endif