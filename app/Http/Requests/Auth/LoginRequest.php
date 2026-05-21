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
     * Permite que cualquier usuario pueda intentar iniciar sesión.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación del login.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Intenta iniciar sesión.
     */
    public function authenticate(): void
    {
        // Primero revisa si el usuario ya está bloqueado
        $this->ensureIsNotRateLimited();

        // Si las credenciales son incorrectas, suma un intento fallido
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey(), 30);

            throw ValidationException::withMessages([
                'email' => 'Las credenciales ingresadas no son correctas.',
            ]);
        }

        // Si inicia sesión correctamente, se limpian los intentos fallidos
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Verifica si ya se superaron los intentos permitidos.
     */
    public function ensureIsNotRateLimited(): void
    {
        // Permitimos máximo 3 intentos fallidos
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
            return;
        }

        event(new Lockout($this));

        // Segundos restantes del bloqueo
        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => 'Has superado el número máximo de intentos permitidos.',
            'bloqueo_segundos' => $seconds,
        ]);
    }

    /**
     * Llave única para controlar intentos por correo e IP.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(
            Str::lower($this->string('email')).'|'.$this->ip()
        );
    }
}