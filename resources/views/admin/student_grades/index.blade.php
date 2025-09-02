@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-book mr-3 text-blue-500"></i> Todas las notas registradas
            </h1>
            <p class="text-gray-600 mt-2">Gestión completa del sistema de calificaciones</p>
        </div>

        <!-- Botones para asignar nuevas notas -->
<div class="mb-8 bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <h2 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
        <i class="fas fa-plus-circle mr-2 text-green-500"></i> Asignar nuevas notas
    </h2>
    <div class="flex flex-wrap gap-3">
        @foreach($gradesList as $grade)
            <a 
href="{{ route('admin.student_grades.create', ['gradeId' => $grade->id_grade]) }}"

                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white font-medium rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
            >
                <i class="fas fa-pen-alt mr-2"></i> {{ $grade->name }}
            </a>
        @endforeach
    </div>
</div>


        <!-- Tabla de notas -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                    <i class="fas fa-list-alt mr-2 text-blue-500"></i> Registro de calificaciones
                </h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-user mr-2 text-blue-400"></i> Estudiante
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-graduation-cap mr-2 text-blue-400"></i> Grado
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-book mr-2 text-blue-400"></i> Materia
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-blue-50">P1</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-green-50">P2</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-yellow-50">P3</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-red-50">P4</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-cog mr-2 text-blue-400"></i> Acciones
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($grades as $gradeNote)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $gradeNote->student->name ?? 'Desconocido' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-700">
                                        {{ $gradeNote->grade->name ?? 'Desconocido' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-700">
                                        {{ $gradeNote->subject }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center bg-blue-50">
                                    <span class="px-2 py-1 text-xs font-bold bg-blue-100 text-blue-800 rounded-full">
                                        {{ $gradeNote->period1 ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center bg-green-50">
                                    <span class="px-2 py-1 text-xs font-bold bg-green-100 text-green-800 rounded-full">
                                        {{ $gradeNote->period2 ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center bg-yellow-50">
                                    <span class="px-2 py-1 text-xs font-bold bg-yellow-100 text-yellow-800 rounded-full">
                                        {{ $gradeNote->period3 ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center bg-red-50">
                                    <span class="px-2 py-1 text-xs font-bold bg-red-100 text-red-800 rounded-full">
                                        {{ $gradeNote->period4 ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.student_grades.edit', $gradeNote->id) }}" 
                                           class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-lg hover:bg-blue-200 transition duration-200">
                                            <i class="fas fa-edit mr-1"></i> Editar
                                        </a>
                                        <form action="{{ route('admin.student_grades.destroy', $gradeNote->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar esta nota?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 text-sm font-medium rounded-lg hover:bg-red-200 transition duration-200">
                                                <i class="fas fa-trash-alt mr-1"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400 py-8">
                                        <i class="fas fa-clipboard-list text-4xl mb-3"></i>
                                        <p class="text-lg font-medium">No hay notas registradas</p>
                                        <p class="text-sm mt-1">Comienza asignando calificaciones a los estudiantes</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Información adicional -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Información</h3>
                    <div class="mt-1 text-sm text-blue-700">
                        <p>P1: Primer período | P2: Segundo período | P3: Tercer período | P4: Cuarto período</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Incluir Font Awesome para los iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Efectos adicionales */
    .hover-lift:hover {
        transform: translateY(-2px);
        transition: transform 0.2s ease;
    }
</style>

<script>
    // Efectos de hover mejorados
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('a, button');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.classList.add('hover-lift');
            });
            button.addEventListener('mouseleave', function() {
                this.classList.remove('hover-lift');
            });
        });
    });
</script>
@endsection