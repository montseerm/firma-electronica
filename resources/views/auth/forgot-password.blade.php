<x-guest-layout>
    <header class="auth-header">
        <h1>Recuperar contraseña</h1>

        <p>
            Introduce el correo electrónico registrado en el sistema para recibir el enlace de recuperación.
        </p>
    </header>

    @if (session('status'))
        <div class="auth-message auth-message-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="auth-message auth-message-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <label for="email">Correo electrónico</label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="ejemplo@pjcdmx.gob.mx"
            >
        </div>

        <button type="submit" class="auth-button">
            Enviar enlace de recuperación
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