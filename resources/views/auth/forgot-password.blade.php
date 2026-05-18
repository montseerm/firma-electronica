<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña | Firma Judicial</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#eef4f5] flex items-center justify-center px-4 py-10" style="font-family: Arial, Helvetica, sans-serif;">
    <main class="w-full max-w-[460px]">

        <section class="bg-white border border-gray-200 shadow-xl px-8 py-10 sm:px-10">

            <!-- Encabezado -->
            <header class="text-center mb-8">
                <div class="mx-auto mb-5 flex items-center justify-center">
                    <img
                        src="{{ asset('img/logo-firmajudicial.png') }}"
                        alt="Logo Firma Judicial"
                        class="h-16 object-contain"
                        onerror="this.style.display='none'"
                    >
                </div>

                <h1 class="text-2xl sm:text-3xl font-bold text-[#00345c]">
                    Recuperar contraseña
                </h1>

                <p class="mt-3 text-sm leading-relaxed text-gray-500">
                    Por favor introduce tu cuenta de correo electronico ya antes registrado. 
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
            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <!-- Correo electrónico -->
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
                        class="block w-full border border-gray-300 bg-white px-5 py-4 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#00857d] focus:ring-2 focus:ring-[#00857d]/30"
                    >

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Botón -->
                <button
                    type="submit"
                    class="w-full bg-[#00857d] py-4 text-white font-semibold shadow-lg shadow-[#00857d]/20 transition hover:bg-[#006f69] active:scale-[0.99]"
                >
                Enviar enlace de recuperación 
                </button>

                <!-- Regresar -->
                <div class="text-center pt-1">
                    <a href="{{ route('login') }}" class="text-sm font-bold text-[#00345c] hover:text-[#00857d]">
                        Regresar al inicio de sesión
                    </a>
                </div>
            </form>

        </section>

        <p class="text-center text-xs text-gray-400 mt-5">
            Poder Judicial de la Ciudad de México · Firma Digital
        </p>

    </main>

</body>
</html>