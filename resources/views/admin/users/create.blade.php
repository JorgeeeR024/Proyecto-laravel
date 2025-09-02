@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-bold text-2xl bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            ➕ Crear Usuario
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-8">

                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">
                            Nombre del usuario
                        </label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">
                            Email del usuario
                        </label>
                        <input type="email" name="email" id="email" required
                            class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">
                            Contraseña del usuario
                        </label>
                        <input type="password" name="password" id="password" required
                            class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Rol -->
                    <div>
                        <label for="role" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">
                            Rol del usuario
                        </label>
                        <select name="role" id="role" required
                            class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="">Selecciona un rol</option>
                            <option value="admin">Administrador</option>
                            <option value="teacher">Profesor</option>
                            <option value="student">Estudiante</option>
                        </select>
                    </div>

                    <!-- Botón -->
                    <div>
                        <button type="submit"
                            class="w-full py-3 bg-gradient-to-r from-blue-900 to-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:scale-105 hover:from-blue-700 hover:to-indigo-700 transition-transform duration-200">
                             Crear Usuario
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection