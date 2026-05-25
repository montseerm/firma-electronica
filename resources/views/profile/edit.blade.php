<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Encabezado de la sección -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-900">
                    Perfil de usuario
                </h2>

                <p class="mt-2 text-sm text-gray-600">
                    Consulta tu información de acceso y actualiza tu contraseña de manera segura.
                </p>
            </div>

            <!-- Contenedor principal -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- Información del perfil -->
                <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6 sm:p-8">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Actualizar contraseña -->
                <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6 sm:p-8">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>