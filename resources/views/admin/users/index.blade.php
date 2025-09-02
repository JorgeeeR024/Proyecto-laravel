@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    <i class="fas fa-users mr-2 text-blue-500"></i>Gestión de Usuarios
                </h1>
                <button id="themeToggle" class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <i class="fas fa-moon" id="themeIcon"></i>
                </button>
            </div>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Administra los usuarios del sistema</p>
        </div>

        <!-- Panel de búsqueda y acciones -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input 
                        type="text" 
                        id="searchInput" 
                        class="pl-10 pr-4 py-2 w-full border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200" 
                        placeholder="Buscar usuarios..."
                    >
                </div>
                
                <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md flex items-center justify-center">
                    <i class="fas fa-user-plus mr-2"></i> Nuevo Usuario
                </a>
            </div>
        </div>

        <!-- Tabla de usuarios -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Email</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Rol</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody" class="divide-y divide-gray-200 dark:divide-gray-600">
                    @foreach($users as $user)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="py-4 px-6 text-gray-900 dark:text-white">{{$user->name}}</td>
                        <td class="py-4 px-6 text-gray-600 dark:text-gray-400">{{$user->email}}</td>
                        <td class="py-4 px-6">
                            @if($user->role == 'admin')
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full dark:bg-blue-900 dark:text-blue-200">Admin</span>
                            @elseif($user->role == 'teacher')
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full dark:bg-purple-900 dark:text-purple-200">Profesor</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full dark:bg-gray-700 dark:text-gray-200">Estudiante</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex space-x-2">
                                <a href="{{route('admin.users.edit', $user->id_user)}}" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-md transition-colors">
                                    <i class="fas fa-edit mr-1"></i> Editar
                                </a>
                                <form action="{{route('admin.users.destroy', $user->id_user)}}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-sm rounded-md transition-colors" onclick="return confirm('¿Está seguro de eliminar este usuario?')">
                                        <i class="fas fa-trash mr-1"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Mensaje sin resultados -->
            <div id="noResults" class="hidden p-8 text-center bg-gray-50 dark:bg-gray-700">
                <i class="fas fa-search fa-2x text-gray-400 mb-3"></i>
                <p class="text-gray-500 dark:text-gray-400">No se encontraron usuarios</p>
            </div>
        </div>

        <!-- Contador de resultados -->
        <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
            Mostrando <span id="resultCount" class="font-medium">{{ count($users) }}</span> usuarios
        </div>
    </div>
</div>

<script>
    // Funcionalidad de búsqueda
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const userRows = document.querySelectorAll('tbody tr');
        const noResults = document.getElementById('noResults');
        const resultCount = document.getElementById('resultCount');
        
        searchInput.addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            let visibleCount = 0;
            
            userRows.forEach(row => {
                const name = row.cells[0].textContent.toLowerCase();
                const email = row.cells[1].textContent.toLowerCase();
                const role = row.cells[2].textContent.toLowerCase();
                
                if (name.includes(searchText) || email.includes(searchText) || role.includes(searchText)) {
                    row.classList.remove('hidden');
                    visibleCount++;
                } else {
                    row.classList.add('hidden');
                }
            });
            
            // Actualizar contador
            resultCount.textContent = visibleCount;
                
            // Mostrar/ocultar mensaje sin resultados
            if (visibleCount === 0 && searchText !== '') {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        });
        
        // Toggle de tema
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        
        // Verificar preferencia guardada
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
            themeIcon.classList.replace('fa-moon', 'fa-sun');
        }
        
        themeToggle.addEventListener('click', function() {
            // Cambiar icono
            themeIcon.classList.toggle('fa-moon');
            themeIcon.classList.toggle('fa-sun');
            
            // Cambiar tema
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    });
</script>
@endsection 