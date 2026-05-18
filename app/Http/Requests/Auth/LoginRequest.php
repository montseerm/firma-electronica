<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determina si el usuario puede hacer esta petición.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación del formulario de login.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Intenta autenticar al usuario.
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {

            // Cada intento fallido se guarda por 10 segundos.
            RateLimiter::hit($this->throttleKey(), 10);

            throw ValidationException::withMessages([
                'email' => 'Ingresar correo y contraseña correctos.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Verifica si el usuario ya excedió el número de intentos.
     */
    public function ensureIsNotRateLimited(): void
    {
        // intentos fallidos.
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 2)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        // Se manda el tiempo restante a la vista para mostrar el modal.
        session()->flash('lockout_seconds', $seconds);

    
    }

    /**
     * Llave única para contar intentos por correo e IP.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }
}