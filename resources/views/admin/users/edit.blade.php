@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl overflow-hidden">
            
            <!-- Header del formulario -->
            <div class="bg-gray-100 dark:bg-gray-800 px-8 py-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                    ✨ Editar Usuario
                </h2>
                <p class="mt-1 text-gray-500 dark:text-gray-400 text-sm">
                    Actualiza la información del usuario de manera segura.
                </p>
            </div>

            <!-- Formulario -->
            <form action="{{ route('admin.users.update', $user->id_user) }}" method="POST" class="px-8 py-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Nombre</label>
                    <input type="text" name="name" value="{{ $user->name }}" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg 
                        dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 
                        focus:border-blue-500 transition duration-150" 
                        placeholder="Nombre completo del usuario">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Correo Electrónico</label>
                    <input type="email" name="email" value="{{ $user->email }}" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg 
                        dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 
                        focus:border-blue-500 transition duration-150" 
                        placeholder="usuario@ejemplo.com">
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">
                        Contraseña
                    </label>
                    <input type="password" name="password" placeholder="••••••••"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg 
                        dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 
                        focus:border-blue-500 transition duration-150">
                    <p class="mt-1 text-gray-500 dark:text-gray-400 text-sm">
                        Dejar vacío para mantener la contraseña actual.
                    </p>
                </div>

                <!-- Rol -->
                <div>
                    <label for="role" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">
                        Rol
                    </label>
                    <select name="role" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg 
                        dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 
                        focus:border-blue-500 transition duration-150">
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrador</option>
                        <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Profesor</option>
                        <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Estudiante</option>
                    </select>
                </div>

                <!-- Botón -->
                <div>
                    <button type="submit"
                        class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg 
                        shadow-md hover:shadow-lg transition duration-200">
                        💾 Guardar Cambios
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
