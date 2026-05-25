<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta | Firma Judicial</title>

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
                    Crear cuenta
                </h1>

                <p class="mt-3 text-sm leading-relaxed text-gray-500">
                    Registra tus datos para ingresar.
                </p>
            </header>

            <!-- Errores generales -->
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
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Numero de empleado -->
                 <div>
                    <label for="name" class="block mb 2 text-sm font-bold text-[#00345c]">
                        Número de empleado
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('numero_de_empleado') }}"
                        required
                        autofocus
                        autocomplete="numero_de_empleado"
                        placeholder="Ingresa tu numero de empleado"
                        class="block w-full border border-gray-300 bg-white px-5 py-4 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#00857d] focus:ring-2 focus:ring-[#00857d]/30"
                    >

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <!-- Nombre -->
                <div>
                    <label for="name" class="block mb-2 text-sm font-bold text-[#00345c]">
                        Nombre completo
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Ingresa tu nombre completo"
                        class="block w-full border border-gray-300 bg-white px-5 py-4 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#00857d] focus:ring-2 focus:ring-[#00857d]/30"
                    >

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

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
                        autocomplete="username"
                        placeholder="ejemplo@ejemplo.com"
                        class="block w-full border border-gray-300 bg-white px-5 py-4 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#00857d] focus:ring-2 focus:ring-[#00857d]/30"
                    >

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
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
                        autocomplete="new-password"
                        placeholder="Crea una contraseña"
                        class="block w-full border border-gray-300 bg-white px-5 py-4 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#00857d] focus:ring-2 focus:ring-[#00857d]/30"
                    >

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Confirmar contraseña -->
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-bold text-[#00345c]">
                        Confirmar contraseña
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Confirma tu contraseña"
                        class="block w-full border border-gray-300 bg-white px-5 py-4 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#00857d] focus:ring-2 focus:ring-[#00857d]/30"
                    >

                    @error('password_confirmation')
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
                    Crear Cuenta
                </button>

                <!-- Regresar al login -->
                <div class="text-center pt-1">
                    <a href="{{ route('login') }}" class="text-sm font-bold text-[#00345c] hover:text-[#00857d]">
                        Ya tengo una cuenta
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