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
     * Determina si el usuario está autorizado para hacer esta petición.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para el login.
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

        // Cada intento fallido se guarda durante 60 segundos.
        RateLimiter::hit($this->throttleKey(), 60);

        throw ValidationException::withMessages([
            'email' => 'Las credenciales ingresadas no son correctas.',
        ]);
    }

    RateLimiter::clear($this->throttleKey());
}
    /**
     * Verifica si el usuario ya superó el límite de intentos.
     */
public function ensureIsNotRateLimited(): void
{
    // Permitimos máximo 3 intentos.
    if (! RateLimiter::tooManyAttempts($this->throttleKey(), 2)) {
        return;
    }

    event(new Lockout($this));

    $seconds = RateLimiter::availableIn($this->throttleKey());

    // Guardamos los segundos en sesión para usarlos en el modal del login.
    session()->flash('lockout_seconds', $seconds);

    throw ValidationException::withMessages([
        'email' => 'Ingresa nuevamente usuario y contraseña',
    ]);
}

    /**
     * Llave única para contar intentos por correo e IP.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}