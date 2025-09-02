@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl"> <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 border border-gray-100"> <!-- Header --> <div class="mb-8 text-center"> <h1 class="text-3xl font-bold text-gray-900 mb-2">Editar Resultado</h1> <p class="text-gray-600">Actualice la calificación y comentarios del estudiante</p> </div>


    <!-- Form -->
    <form action="{{ route('teacher.evaluation_results.update', $result->id_result) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Student Selection -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Estudiante</label>
            <select name="student_id" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                @foreach($students as $student)
                    <option value="{{ $student->id_user }}" {{ $result->student_id == $student->id_user ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Evaluation Selection -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Evaluación</label>
            <select name="evaluation_id" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                @foreach($evaluations as $evaluation)
                    <option value="{{ $evaluation->id_evaluation }}" {{ $result->evaluation_id == $evaluation->id_evaluation ? 'selected' : '' }}>
                        {{ $evaluation->title }} ({{ ucfirst($evaluation->type) }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Score -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nota</label>
            <input type="number" step="0.01" name="score" value="{{ old('score', $result->score) }}" 
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                min="0" max="20">
        </div>

        <!-- Comments -->
        <div class="mb-8">
            <label class="block text-sm font-medium text-gray-700 mb-2">Comentarios</label>
            <textarea name="comments" rows="4" 
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">{{ old('comments', $result->comments) }}</textarea>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-4 pt-4">
            <a href="{{ route('teacher.evaluation_results.index') }}" class="px-5 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition duration-200">
                Cancelar
            </a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-lg shadow-md transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Actualizar Resultado
            </button>
        </div>
    </form>
</div>

</div>
 @endsection