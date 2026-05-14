<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión | Firma Judicial</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#eef4f5] flex items-center justify-center px-4 py-10">
    @php
    $lockoutSeconds = session('lockout_seconds');
    @endphp

    <main class="w-full max-w-[460px]">

        <section class="bg-white shadow-xl border border-gray-200 px-8 py-10 sm:px-10">

            <header class="text-center mb-8">
                <div class="mx-auto mb-5 flex items-center justify-center">
    <img
        src="{{ asset('img/logo-firmajudicial.png') }}"
        alt="Logo Firma Judicial"
        class="h-16 object-contain"
    >
</div>

                <h1 class="text-2x1 sm:text-2xl font-extrabold text-[#00345c]">
                    Inicio de sesión
                </h1>


            </header>

            @if (session('status'))
                <div class="mb-5 rounded-xl border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

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
                        auocomplete="username"
                        placeholder="ejemplo@pjcdmx.gob.mx"
                        @if($lockoutSeconds) disabled @endif
                        class="block w-full rounded-2xl border border-gray-300 bg-white px-5 py-4 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#00857d] focus:ring-2 focus:ring-[#00857d]/30"
                    >
                </div>

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
                        @if($lockoutSeconds) disabled @endif
                        class="block w-full rounded-2xl border border-gray-300 bg-white px-5 py-4 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#00857d] focus:ring-2 focus:ring-[#00857d]/30"
                    >
                </div>

                @if (Route::has('password.request'))
                    <div class="text-right">
                        <a href="{{ route('password.request') }}" class="text-sm font-bold text-[#00857d] hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                @endif

                <button
                    type="submit"
                    id="btnLogin"
                    @if($lockoutSeconds) disabled @endif
                    class="w-full rounded-2xl bg-[#00857d] py-4 text-white font-extrabold shadow-lg shadow-[#00857d]/20 transition hover:bg-[#006f69] active:scale-[0.99]"
                >
                    INICIAR SESIÓN
                </button>

                @if (Route::has('register'))
                    <div class="text-center pt-1">
                        <a href="{{ route('register') }}" class="text-sm font-bold text-[#00345c] hover:text-[#00857d]">
                            Crear cuenta nueva
                        </a>
                    </div>
                @endif
            </form>

        </section>



    </main>
    @if($lockoutSeconds)
    <div 
        id="modalBloqueo"
        class="fixed inset-0 bg-black/50 flex items-center justify-center px-4 z-50"
    >
        <div class="bg-white w-full max-w-md shadow-2xl border border-gray-200 p-8 text-center">
            
            <div class="mx-auto mb-5 w-16 h-16 bg-red-100 flex items-center justify-center">
                <span class="text-3xl text-red-600 font-black">!</span>
            </div>

            <h2 class="text-2xl font-extrabold text-[#00345c] mb-3">
                Intentos excedidos
            </h2>

            <p class="text-gray-600 mb-5">
                Has superado el número máximo de intentos permitidos.
                Por seguridad, el acceso fue bloqueado temporalmente.
            </p>

            <div class="bg-[#eef4f5] border border-gray-200 px-4 py-3 mb-6">
                <p class="text-sm text-gray-600">
                    Podrás intentar nuevamente en:
                </p>

                <p class="text-3xl font-extrabold text-[#00857d] mt-1">
                    <span id="contadorBloqueo">{{ $lockoutSeconds }}</span>s
                </p>
            </div>

            <p class="text-xs text-gray-400">
                El formulario se habilitará automáticamente al terminar el tiempo de bloqueo.
            </p>
        </div>
    </div>

    <script>
        let segundos = {{ $lockoutSeconds }};
        const contador = document.getElementById('contadorBloqueo');
        const modal = document.getElementById('modalBloqueo');

        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const boton = document.getElementById('btnLogin');

        const intervalo = setInterval(() => {
            segundos--;

            if (contador) {
                contador.textContent = segundos;
            }

            if (segundos <= 0) {
                clearInterval(intervalo);

                if (modal) {
                    modal.style.display = 'none';
                }

                if (email) {
                    email.disabled = false;
                }

                if (password) {
                    password.disabled = false;
                }

                if (boton) {
                    boton.disabled = false;
                }
            }
        }, 1000);
    </script>
@endif

</body>
</html>