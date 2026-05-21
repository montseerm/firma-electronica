<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
        @csrf
        @method('put')

        <!-- Contraseña actual -->
        <div>
            <label for="update_password_current_password" class="block text-[16px] font-medium text-[#1b1f23] mb-2">
                Contraseña actual
            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="w-full md:w-[500px] h-[52px] border border-gray-300 bg-white px-4 text-[16px] text-gray-700 outline-none rounded-sm focus:border-[#00857d]"
            >

            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- Nueva contraseña -->
        <div>
            <label for="update_password_password" class="block text-[16px] font-medium text-[#1b1f23] mb-2">
                Nueva contraseña
            </label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="w-full md:w-[500px] h-[52px] border border-gray-300 bg-white px-4 text-[16px] text-gray-700 outline-none rounded-sm focus:border-[#00857d]"
            >

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar contraseña -->
        <div>
            <label for="update_password_password_confirmation" class="block text-[16px] font-medium text-[#1b1f23] mb-2">
                Confirmar nueva contraseña
            </label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="w-full md:w-[500px] h-[52px] border border-gray-300 bg-white px-4 text-[16px] text-gray-700 outline-none rounded-sm focus:border-[#00857d]"
            >

            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botón -->
        <div class="flex items-center gap-4 pt-2">
            <button
                type="submit"
                class="min-w-[220px] h-[48px] bg-[#00857d] hover:bg-[#006f69] text-white text-[18px] font-normal rounded-sm transition"
            >
                Guardar cambios
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm text-green-700"
                >
                    Contraseña actualizada correctamente.
                </p>
            @endif
        </div>
    </form>
</section>