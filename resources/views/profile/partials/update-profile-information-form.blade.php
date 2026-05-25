<section>
    <header class="mb-6">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">
                    Información del perfil
                </h3>

                <p class="mt-1 text-sm text-gray-600">
                    Estos datos son informativos y no pueden modificarse desde esta pantalla.
                </p>
            </div>
        </div>
    </header>

    <div class="space-y-6">
        <!-- Numero de empleado -->
         <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                Número de empleado
            </label>
            <input
                id="numero_de_empleado"
                type="num"
                value="{{ $user->numero_de_empleado }}"
                disabled
                class="mt-2 block w-full rounded-md border-gray-300 bg-gray-100 text-gray-700 shadow-sm cursor-not-allowed"
            >

            <p class="mt-2 text-xs text-gray-500">
                Este dato está bloqueado para edición.
            </p>
        </div>

    <div class="space-y-6">
        <!-- Nombre -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                Nombre
            </label>

            <input
                id="name"
                type="text"
                value="{{ $user->name }}"
                disabled
                class="mt-2 block w-full rounded-md border-gray-300 bg-gray-100 text-gray-700 shadow-sm cursor-not-allowed"
            >

            <p class="mt-2 text-xs text-gray-500">
                Este dato está bloqueado para edición.
            </p>
        </div>

        <!-- Correo electrónico -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                Correo electrónico
            </label>

            <input
                id="email"
                type="email"
                value="{{ $user->email }}"
                disabled
                class="mt-2 block w-full rounded-md border-gray-300 bg-gray-100 text-gray-700 shadow-sm cursor-not-allowed"
            >

            <p class="mt-2 text-xs text-gray-500">
                El correo está vinculado al acceso del sistema.
            </p>
        </div>
    </div>
</section>