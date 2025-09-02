@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-4 md:p-6"> <div class="max-w-7xl mx-auto"> <!-- Header --> <div class="mb-8"> <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Panel de Administración</h1> <p class="text-gray-600 dark:text-gray-400 mt-2">Bienvenido al centro de control del sistema</p> </div>

<center>
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-blue-100 dark:bg-blue-900/40">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Usuarios Totales</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $usersCount }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-green-100 dark:bg-green-900/40">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Estudiantes</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $studentsCount }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 transition-all duration-300 hover:shadow-lg">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-purple-100 dark:bg-purple-900/40">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Profesores</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $teachersCount }}</p>
                </div>
            </div>
        </div>

       
    </div>
    </center>

    <!-- Welcome Panel -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-700 dark:to-indigo-800 rounded-2xl shadow-lg overflow-hidden mb-10">
        <div class="p-6 md:p-8 text-white">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-6 md:mb-0 md:mr-6">
                    <h2 class="text-2xl font-bold mb-2">¡Bienvenido de nuevo!</h2>
                    <p class="opacity-90 max-w-lg">Gestiona todos los aspectos de tu plataforma educativa desde este panel de control centralizado.</p>
                </div>
                <div class="flex-shrink-0">
                    <div class="bg-white/20 p-4 rounded-xl backdrop-blur-sm">
                        <p class="text-sm font-medium">Acciones rápidas</p>
<div class="flex space-x-3 mt-2">
    <a href="{{ url('admin/users/create') }}" 
       class="bg-white text-blue-600 px-3 py-1.5 rounded-lg text-sm font-semibold hover:bg-blue-50 transition-colors">
        + Usuario
    </a>

    <a href="{{ url('admin/evaluations.index') }}" 
       class="bg-white text-blue-600 px-3 py-1.5 rounded-lg text-sm font-semibold hover:bg-blue-50 transition-colors">
        Ver Reportes
    </a>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Content -->
   <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Últimos usuarios registrados -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Últimos Usuarios</h3>
        <div class="space-y-4">
@foreach($latestUsers as $user)
    <div class="flex items-start">
        <div class="bg-blue-100 dark:bg-blue-900/40 p-2 rounded-full mr-3">
            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.79.755 6.879 2.053M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <div>
            <p class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->created_at->diffForHumans() }}</p>
        </div>
    </div>
@endforeach

        </div>
    </div>

    <!-- Estadísticas del sistema -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Estadísticas del Sistema</h3>
        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <span class="text-gray-600 dark:text-gray-400">Usuarios registrados</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $totalUsers }}</span>
            </div>

            <div class="flex justify-between items-center pt-2">
                <span class="text-gray-600 dark:text-gray-400">Profesores</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $totalTeachers }}</span>
            </div>
            
            <div class="flex justify-between items-center pt-2">
                <span class="text-gray-600 dark:text-gray-400">Estudiantes</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $totalStudents }}</span>
            </div>
            
            <div class="flex justify-between items-center pt-2">
                <span class="text-gray-600 dark:text-gray-400">Estado del sistema</span>
                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 
                            dark:bg-green-900/30 dark:text-green-400 rounded-full">En línea</span>
            </div>
        </div>
    </div>
</div>


</div> @endsection

@push('styles')
<style> .bg-gradient-to-r { background-image: linear-gradient(to right, var(--tw-gradient-stops)); } .backdrop-blur-sm { backdrop-filter: blur(4px); } </style>

@endpush

