import './bootstrap';

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

    const intervaloBloqueo = setInterval(() => {
        segundosRestantes--;

        if (contadorBloqueo) {
            contadorBloqueo.textContent = segundosRestantes;
        }

        if (segundosRestantes <= 0) {
            clearInterval(intervaloBloqueo);

            modalBloqueo.classList.add('hidden');

            if (inputCorreo) {
                inputCorreo.disabled = false;
            }

            if (inputPassword) {
                inputPassword.disabled = false;
            }

            if (botonLogin) {
                botonLogin.disabled = false;
            }
        }
    }, 1000);
});