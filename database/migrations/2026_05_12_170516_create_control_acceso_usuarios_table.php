<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('control_acceso_usuarios', function (Blueprint $table) {
            $table->id();

            // Relación con el usuario que intentó iniciar sesión.
            // Es nullable porque puede intentar entrar un correo no registrado.
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Correo ingresado en el formulario de login.
            $table->string('email');

            // IP desde donde se hizo el intento.
            $table->string('ip', 45)->nullable();

            // Indica si el acceso fue exitoso o fallido.
            $table->boolean('exitoso')->default(false);

            // Motivo del resultado: credenciales incorrectas, bloqueado, exitoso, etc.
            $table->string('motivo')->nullable();

            // Número de intento acumulado al momento del registro.
            $table->unsignedTinyInteger('numero_intento')->default(0);

            // Indica si en ese momento la cuenta quedó bloqueada.
            $table->boolean('bloqueado')->default(false);

            // Hasta cuándo queda bloqueada la cuenta, si aplica.
            $table->timestamp('bloqueado_hasta')->nullable();

            // Fecha exacta del intento.
            $table->timestamp('fecha_intento')->useCurrent();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('control_acceso_usuarios');
    }
};