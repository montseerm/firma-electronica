<x-guest-layout>
    <header class="auth-header">
        <h1>Restablecer contraseña</h1>

        <p>
            Ingresa tu nueva contraseña para recuperar el acceso al sistema.
        </p>
    </header>

    @if ($errors->any())
        <div class="auth-message auth-message-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}" class="auth-form">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="auth-field">
            <label for="email">Correo electrónico</label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                required
                autofocus
                autocomplete="username"
                placeholder="ejemplo@pjcdmx.gob.mx"
            >
        </div>

        <div class="auth-field">
            <label for="password">Nueva contraseña</label>

            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Ingresa tu nueva contraseña"
            >
        </div>

        <div class="auth-field">
            <label for="password_confirmation">Confirmar contraseña</label>

            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Confirma tu nueva contraseña"
            >
        </div>

        <button type="submit" class="auth-button">
            Restablecer contraseña
        </button>

        <div class="auth-links">
            <a href="{{ route('login') }}">
                Regresar al inicio de sesión
            </a>
        </div>
    </form>

    <p class="auth-footer">
        Poder Judicial de la Ciudad de México · Firma Digital
    </p>
</x-guest-layout>