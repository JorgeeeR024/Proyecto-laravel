@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="container mx-auto p-6">
        <!-- Header profesional -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="bg-gray-900 p-3 rounded-lg">
                    <i class="fas fa-graduation-cap text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Mis Grados</h1>
                    <p class="text-gray-600">Gestiona los grados asignados para el período académico actual</p>
                </div>
            </div>
            
            <!-- Panel de información -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <i class="fas fa-chart-bar text-blue-600 text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $grades->count() }} Grados Asignados</h3>
                            <p class="text-gray-600 text-sm">Total de estudiantes: {{ $grades->sum('students_count') }}</p>
                        </div>
                    </div>
                    <div class="hidden sm:block">
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-md text-sm font-medium">
                            Período 2024
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid de grados profesional -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($grades as $grade)
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 p-6 border border-gray-200">
                    <!-- Indicador superior -->
                    <div class="h-1 bg-blue-600 rounded-full mb-5"></div>
                    
                    <!-- Header -->
                    <div class="mb-5">
                        <div class="flex items-start justify-between mb-3">
                            <h2 class="text-lg font-bold text-gray-900 leading-tight">
                                {{ $grade->name }}
                            </h2>
                            <span class="bg-gray-100 text-gray-700 text-xs font-medium px-2 py-1 rounded">
                                {{ $grade->students_count ?? 0 }}
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm font-medium">
                            <i class="fas fa-book text-gray-400 mr-2"></i>
                            {{ $grade->subject ?? 'Asignatura' }}
                        </p>
                    </div>

                    <!-- Información de estudiantes -->
                    @if($grade->students_count)
                        <div class="mb-5">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-sm font-semibold text-gray-700">Estudiantes</h4>
                                <span class="text-xs text-gray-500">{{ $grade->students_count }} total</span>
                            </div>
                            <div class="bg-gray-50 rounded-md p-3 max-h-32 overflow-y-auto">
                                <ul class="space-y-2">
                                    @foreach($grade->students as $student)
                                        <li class="text-sm text-gray-700 flex items-center gap-2">
                                            <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                                            {{ $student->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="mb-5">
                            <div class="bg-gray-50 rounded-md p-4 text-center">
                                <i class="fas fa-users text-gray-300 text-lg mb-2"></i>
                                <p class="text-gray-500 text-sm">Sin estudiantes asignados</p>
                            </div>
                        </div>
                    @endif

                    <!-- Botón de acción -->
                    <a href="{{ route('teacher.gestion_grades.show', $grade->id_grade) }}"
                       class="block w-full text-center bg-gray-900 hover:bg-gray-800 text-white font-medium py-2.5 px-4 rounded-md transition-colors duration-200 text-sm">
                        <i class="fas fa-eye mr-2"></i>
                        Ver Detalles
                    </a>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-lg shadow-sm p-12 text-center border border-gray-200">
                        <div class="bg-gray-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-graduation-cap text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No hay grados asignados</h3>
                        <p class="text-gray-600 mb-4">Contacta con el administrador para solicitar la asignación de grados.</p>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium text-sm transition-colors duration-200">
                            Solicitar Asignación
                        </button>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection