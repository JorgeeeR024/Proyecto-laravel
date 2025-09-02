<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
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
        
        .success-message {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .password-toggle {
            cursor: pointer;
            transition: color 0.2s ease;
        }
        
        .password-toggle:hover {
            color: #4f46e5;
        }
        
        .logo {
            font-weight: 700;
            letter-spacing: -0.5px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                    <i class="fa-solid fa-lock text-2xl"></i>
                </div>
            </div>
            <h1 class="text-2xl font-bold mb-2">Recuperar Contraseña</h1>
            <p class="text-blue-100 opacity-90">Ingresa tu correo para recibir el enlace de restablecimiento</p>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf
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
                            value="{{ old('email') }}"
                            required 
                            autofocus 
                            class="py-3 px-4 pl-10 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 input-transition"
                            placeholder="nombre@ejemplo.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fa-solid fa-circle-exclamation mr-1.5"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 btn-transition">
                        <i class="fa-solid fa-paper-plane mr-2.5"></i>
                        Enviar Enlace de Restablecimiento
                    </button>
                </div>
                
                <div class="text-center pt-2">
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        Volver al inicio de sesión
                    </a>
                </div>
            </form>

            @if(session('status'))
            <div class="mt-6 p-4 rounded-lg text-sm bg-green-50 text-green-700 border border-green-200 success-message flex items-start">
                <i class="fa-solid fa-circle-check mr-3 mt-0.5"></i>
                <span>{{ session('status') }}</span>
            </div>
            @endif
        </div>
    </div>

    <script>
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