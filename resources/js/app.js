import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/*
|--------------------------------------------------------------------------
| Modal de bloqueo de inicio de sesión
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', () => {
    const modalBloqueo = document.getElementById('modalBloqueo');

    if (!modalBloqueo) {
        return;
    }

    let segundosRestantes = Number(modalBloqueo.dataset.lockoutSeconds || 0);

    const contadorBloqueo = document.getElementById('contadorBloqueo');
    const inputCorreo = document.getElementById('email');
    const inputPassword = document.getElementById('password');
    const botonLogin = document.getElementById('btnLogin');

    const actualizarContador = () => {
        if (contadorBloqueo) {
            contadorBloqueo.textContent = segundosRestantes;
        }
    };

    const bloquearFormulario = () => {
        if (inputCorreo) {
            inputCorreo.disabled = true;
        }

        if (inputPassword) {
            inputPassword.disabled = true;
        }

        if (botonLogin) {
            botonLogin.disabled = true;
            botonLogin.textContent = 'Acceso bloqueado';
        }
    };

    const desbloquearFormulario = () => {
        if (inputCorreo) {
            inputCorreo.disabled = false;
        }

        if (inputPassword) {
            inputPassword.disabled = false;
        }

        if (botonLogin) {
            botonLogin.disabled = false;
            botonLogin.textContent = 'Iniciar sesión';
        }
    };

    const cerrarModal = () => {
        modalBloqueo.classList.add('hidden');
        modalBloqueo.style.display = 'none';
    };

    if (!segundosRestantes || segundosRestantes <= 0) {
        cerrarModal();
        desbloquearFormulario();
        return;
    }

    bloquearFormulario();
    actualizarContador();

    const intervaloBloqueo = setInterval(() => {
        segundosRestantes--;

        if (segundosRestantes <= 0) {
            segundosRestantes = 0;
        }

        actualizarContador();

        if (segundosRestantes <= 0) {
            clearInterval(intervaloBloqueo);
            cerrarModal();
            desbloquearFormulario();
        }
    }, 1000);
});