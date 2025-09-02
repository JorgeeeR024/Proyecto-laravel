<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            width: 100%;
            max-width: 440px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }
        
        .card-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 28px 32px;
            text-align: center;
        }
        
        .card-body {
            padding: 32px;
        }
        
        .input-transition {
            transition: all 0.25s ease;
        }
        
        .input-transition:focus {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        }
        
        .btn-transition {
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-transition:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }
        
        .btn-transition:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }
        
        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }
            100% {
                transform: scale(30, 30);
                opacity: 0;
            }
        }
        
        .password-toggle {
            cursor: pointer;
            transition: color 0.2s ease;
        }
        
        .password-toggle:hover {
            color: #4f46e5;
        }
        
        .password-strength {
            height: 4px;
            border-radius: 2px;
            margin-top: 8px;
            transition: all 0.3s ease;
        }
        
        .password-criteria {
            display: flex;
            align-items: center;
            margin-bottom: 6px;
            font-size: 13px;
            color: #6b7280;
        }
        
        .criteria-icon {
            margin-right: 8px;
            font-size: 12px;
            width: 16px;
            text-align: center;
        }
        
        .criteria-met {
            color: #10b981;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                    <i class="fa-solid fa-key text-2xl"></i>
                </div>
            </div>
            <h1 class="text-2xl font-bold mb-2">Nueva Contraseña</h1>
            <p class="text-blue-100 opacity-90">Crea una nueva contraseña para tu cuenta</p>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-envelope text-gray-400"></i>
                        </div>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            :value="old('email', $request->email)" 
                            required 
                            autofocus 
                            autocomplete="username"
                            class="py-3 px-4 pl-10 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 input-transition"
                            placeholder="nombre@ejemplo.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <button type="button" id="togglePassword" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                            <i class="fa-solid fa-eye mr-1"></i>Mostrar
                        </button>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-400"></i>
                        </div>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            class="py-3 px-4 pl-10 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 input-transition pr-10"
                            placeholder="Ingresa tu nueva contraseña">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fa-solid fa-key text-gray-400"></i>
                        </div>
                    </div>
                    
                    <!-- Password Strength Meter -->
                    <div class="mt-3">
                        <div class="password-strength bg-gray-200" id="password-strength"></div>
                    </div>
                    
                    <!-- Password Criteria -->
                    <div class="mt-3 text-sm" id="password-criteria">
                        <div class="password-criteria" id="criteria-length">
                            <span class="criteria-icon"><i class="fa-solid fa-circle"></i></span>
                            <span>Al menos 8 caracteres</span>
                        </div>
                        <div class="password-criteria" id="criteria-uppercase">
                            <span class="criteria-icon"><i class="fa-solid fa-circle"></i></span>
                            <span>Una letra mayúscula</span>
                        </div>
                        <div class="password-criteria" id="criteria-number">
                            <span class="criteria-icon"><i class="fa-solid fa-circle"></i></span>
                            <span>Un número</span>
                        </div>
                    </div>
                    
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmar Contraseña</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-400"></i>
                        </div>
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            class="py-3 px-4 pl-10 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 input-transition"
                            placeholder="Confirma tu nueva contraseña">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 btn-transition">
                        <i class="fa-solid fa-key mr-2.5"></i>
                        Restablecer Contraseña
                    </button>
                </div>
                
                <div class="text-center pt-2">
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        Volver al inicio de sesión
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Mostrar/ocultar contraseña
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');
        
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            passwordConfirmation.setAttribute('type', type);
            
            const icon = this.querySelector('i');
            if (type === 'text') {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
                this.innerHTML = '<i class="fa-solid fa-eye-slash mr-1"></i>Ocultar';
            } else {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
                this.innerHTML = '<i class="fa-solid fa-eye mr-1"></i>Mostrar';
            }
        });
        
        // Verificar fortaleza de la contraseña
        password.addEventListener('input', function() {
            const value = password.value;
            const strengthBar = document.getElementById('password-strength');
            const criteria = {
                length: value.length >= 8,
                uppercase: /[A-Z]/.test(value),
                number: /[0-9]/.test(value)
            };
            
            // Actualizar criterios
            document.getElementById('criteria-length').classList.toggle('criteria-met', criteria.length);
            document.getElementById('criteria-uppercase').classList.toggle('criteria-met', criteria.uppercase);
            document.getElementById('criteria-number').classList.toggle('criteria-met', criteria.number);
            
            // Actualizar iconos de criterios
            document.querySelectorAll('#password-criteria .criteria-icon i').forEach((icon, index) => {
                const met = Object.values(criteria)[index];
                icon.className = met ? 'fa-solid fa-check' : 'fa-solid fa-circle';
            });
            
            // Calcular fortaleza
            let strength = 0;
            if (value.length > 0) strength += 25;
            if (criteria.length) strength += 25;
            if (criteria.uppercase) strength += 25;
            if (criteria.number) strength += 25;
            
            // Actualizar barra de fortaleza
            if (strength === 0) {
                strengthBar.style.width = '0%';
                strengthBar.style.backgroundColor = '#e5e7eb';
            } else if (strength < 50) {
                strengthBar.style.width = '33%';
                strengthBar.style.backgroundColor = '#ef4444';
            } else if (strength < 75) {
                strengthBar.style.width = '66%';
                strengthBar.style.backgroundColor = '#f59e0b';
            } else {
                strengthBar.style.width = '100%';
                strengthBar.style.backgroundColor = '#10b981';
            }
        });
        
        // Efecto de enfoque mejorado para inputs
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-500', 'ring-opacity-50');
                this.parentElement.classList.remove('border-gray-300');
                this.parentElement.classList.add('border-blue-500');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-blue-500', 'ring-opacity-50');
                this.parentElement.classList.remove('border-blue-500');
                this.parentElement.classList.add('border-gray-300');
            });
        });
    </script>
</body>
</html>