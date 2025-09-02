@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8"> <!-- Header --> <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8"> <div> <h1 class="text-3xl font-bold text-gray-900 mb-2">Notas de Estudiantes</h1> <p class="text-gray-600">Gestión de calificaciones por períodos académicos</p> </div> <a href="{{ route('teacher.student_grades.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-lg shadow-md transition duration-200 flex items-center mt-4 sm:mt-0"> <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path> </svg> Agregar Nueva Nota </a> </div>


<!-- Table Container -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50/80">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Estudiante</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Grado</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Materia</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">P1</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">P2</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">P3</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">P4</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($grades as $gradeNote)
                <tr class="hover:bg-gray-50/50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                <span class="text-indigo-800 font-medium">{{ substr($gradeNote->student->name ?? 'D', 0, 1) }}</span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $gradeNote->student->name ?? 'Desconocido' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $gradeNote->grade->name ?? 'Desconocido' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $gradeNote->subject }}</td>
                    
                    <!-- Period 1 -->
                    <td class="px-6 py-4 text-center">
                        @if($gradeNote->period1)
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full 
                            @if($gradeNote->period1 >= 16) bg-green-100 text-green-800
                            @elseif($gradeNote->period1 >= 11) bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif text-sm font-medium">
                            {{ $gradeNote->period1 }}
                        </span>
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    
                    <!-- Period 2 -->
                    <td class="px-6 py-4 text-center">
                        @if($gradeNote->period2)
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full 
                            @if($gradeNote->period2 >= 16) bg-green-100 text-green-800
                            @elseif($gradeNote->period2 >= 11) bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif text-sm font-medium">
                            {{ $gradeNote->period2 }}
                        </span>
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    
                    <!-- Period 3 -->
                    <td class="px-6 py-4 text-center">
                        @if($gradeNote->period3)
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full 
                            @if($gradeNote->period3 >= 16) bg-green-100 text-green-800
                            @elseif($gradeNote->period3 >= 11) bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif text-sm font-medium">
                            {{ $gradeNote->period3 }}
                        </span>
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    
                    <!-- Period 4 -->
                    <td class="px-6 py-4 text-center">
                        @if($gradeNote->period4)
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full 
                            @if($gradeNote->period4 >= 16) bg-green-100 text-green-800
                            @elseif($gradeNote->period4 >= 11) bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif text-sm font-medium">
                            {{ $gradeNote->period4 }}
                        </span>
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                        <a href="{{ route('teacher.student_grades.edit', $gradeNote->id) }}" class="text-indigo-600 hover:text-indigo-900 transition duration-150 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Editar
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center">
                        <div class="text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-lg font-medium">No hay notas registradas aún</p>
                            <p class="text-sm mt-1">Comience agregando la primera nota</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</div>
 @endsection