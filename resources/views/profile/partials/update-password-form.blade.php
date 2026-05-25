<section>
    <header class="mb-6">
        <h3 class="text-lg font-semibold text-gray-900">
            Actualizar contraseña
        </h3>

        <p class="mt-1 text-sm text-gray-600">
            Utiliza una contraseña segura para proteger tu acceso al sistema.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Contraseña actual -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700">
                Contraseña actual
            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00857d] focus:ring-[#00857d]"
            >

            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- Nueva contraseña -->
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700">
                Nueva contraseña
            </label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00857d] focus:ring-[#00857d]"
            >

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar contraseña -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700">
                Confirmar nueva contraseña
            </label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00857d] focus:ring-[#00857d]"
            >

            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botón -->
        <div class="flex items-center gap-4 pt-2">
            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-md bg-[#00857d] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#006f69] focus:outline-none focus:ring-2 focus:ring-[#00857d] focus:ring-offset-2"
            >
                Guardar contraseña
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm font-medium text-green-700"
                >
                    Contraseña actualizada correctamente.
                </p>
            @endif
        </div>
    </form>
</section>