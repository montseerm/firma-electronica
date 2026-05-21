<x-app-layout>
    <div class="profile-page">

        <section class="profile-card">

            <div class="profile-card-header">
                <div>
                    <h2>Perfil de usuario</h2>
                    <p>Consulta tu información de acceso y actualiza tu contraseña.</p>
                </div>
                
            </div>

            <div class="profile-grid">

                <!-- Información de cuenta -->
                <div class="profile-section account-section">
                    <div class="section-title">
                        <h3>Información de la cuenta</h3>
                        <p>Estos datos son informativos y no pueden modificarse.</p>
                    </div>

                    <div class="input-group">
                        <label>Nombre</label>
                        <input
                            type="text"
                            value="{{ auth()->user()->name }}"
                            disabled
                        >
                        <small>Este dato está bloqueado para edición.</small>
                    </div>

                    <div class="input-group">
                        <label>Correo electrónico</label>
                        <input
                            type="email"
                            value="{{ auth()->user()->email }}"
                            disabled
                        >
                        <small>El correo está vinculado al acceso del sistema.</small>
                    </div>
                </div>

                <!-- Seguridad -->
                <div class="profile-section security-section">
                    <div class="section-title">
                        <h3>Seguridad</h3>
                        <p>Actualiza tu contraseña de acceso.</p>
                    </div>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="input-group">
                            <label for="current_password">Contraseña actual</label>
                            <input
                                id="current_password"
                                name="current_password"
                                type="password"
                                autocomplete="current-password"
                            >

                            @if ($errors->updatePassword->get('current_password'))
                                <small class="error-text">
                                    {{ $errors->updatePassword->first('current_password') }}
                                </small>
                            @endif
                        </div>

                        <div class="input-group">
                            <label for="password">Nueva contraseña</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="new-password"
                            >

                            @if ($errors->updatePassword->get('password'))
                                <small class="error-text">
                                    {{ $errors->updatePassword->first('password') }}
                                </small>
                            @endif
                        </div>

                        <div class="input-group">
                            <label for="password_confirmation">Confirmar nueva contraseña</label>
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                autocomplete="new-password"
                            >

                            @if ($errors->updatePassword->get('password_confirmation'))
                                <small class="error-text">
                                    {{ $errors->updatePassword->first('password_confirmation') }}
                                </small>
                            @endif
                        </div>

                        <div class="form-actions">
                            <button type="submit">
                                Guardar contraseña
                            </button>

                            @if (session('status') === 'password-updated')
                                <span class="success-text">
                                    Contraseña actualizada correctamente.
                                </span>
                            @endif
                        </div>
                    </form>
                </div>

            </div>

        </section>

    </div>

    <style>
        .profile-page {
            max-width: 1180px;
            margin: 0 auto;
            padding: 34px 24px 55px;
        }

        .profile-card {
            background: #ffffff;
            border: 1px solid #d9dee5;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        }

        .profile-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 28px 34px;
            border-bottom: 4px solid #00857d;
        }

        .profile-card-header h2 {
            margin: 0;
            color: #001f3f;
            font-size: 30px;
            font-weight: 500;
            letter-spacing: -0.5px;
        }

        .profile-card-header p {
            margin: 8px 0 0;
            color: #4b5b6b;
            font-size: 15px;
        }

        .profile-badge {
            background: #eef7f6;
            color: #00857d;
            border: 1px solid #00857d;
            padding: 9px 16px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }

        .profile-section {
            padding: 32px 34px;
        }

        .account-section {
            border-right: 1px solid #e2e6ea;
            background: #fbfcfc;
        }

        .security-section {
            background: #ffffff;
        }

        .section-title {
            margin-bottom: 24px;
        }

        .section-title h3 {
            margin: 0;
            color: #001f3f;
            font-size: 22px;
            font-weight: 500;
        }

        .section-title p {
            margin: 7px 0 0;
            color: #4b5b6b;
            font-size: 14px;
            line-height: 1.5;
        }

        .input-group {
            margin-bottom: 18px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #001f3f;
            font-size: 14px;
            font-weight: 600;
        }

        .input-group input {
            width: 100%;
            height: 46px;
            padding: 0 14px;
            border: 1px solid #cbd3dc;
            background: #ffffff;
            color: #001f3f;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .input-group input:focus {
            border-color: #00857d;
            box-shadow: 0 0 0 3px rgba(0, 133, 125, 0.14);
        }

        .input-group input:disabled {
            background: #f1f3f5;
            color: #34495e;
            cursor: not-allowed;
        }

        .input-group small {
            display: block;
            margin-top: 7px;
            color: #6b7785;
            font-size: 12.5px;
        }

        .error-text {
            color: #c0392b !important;
            font-weight: 600;
        }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 24px;
        }

        .form-actions button {
            border: none;
            background: #00857d;
            color: #ffffff;
            padding: 13px 24px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 8px 16px rgba(0, 133, 125, 0.22);
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .form-actions button:hover {
            background: #006f69;
        }

        .form-actions button:active {
            transform: scale(0.98);
        }

        .success-text {
            color: #00857d;
            font-size: 13px;
            font-weight: 600;
        }

        @media (max-width: 900px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }

            .account-section {
                border-right: none;
                border-bottom: 1px solid #e2e6ea;
            }

            .profile-card-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 600px) {
            .profile-page {
                padding: 24px 14px 40px;
            }

            .profile-card-header,
            .profile-section {
                padding: 24px 20px;
            }

            .profile-card-header h2 {
                font-size: 25px;
            }

            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .form-actions button {
                width: 100%;
            }
        }
    </style>
</x-app-layout>