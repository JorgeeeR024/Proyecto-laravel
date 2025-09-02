@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl"> <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 border border-gray-100"> <!-- Header --> <div class="mb-8 text-center"> <h1 class="text-3xl font-bold text-gray-900 mb-2">Editar Evaluación</h1> <p class="text-gray-600">Actualice la información de la evaluación</p> </div>


    <!-- Form -->
    <form action="{{ route('teacher.evaluations.update', $evaluation->id_evaluation) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Título</label>
            <input type="text" name="title" value="{{ old('title', $evaluation->title) }}" 
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
        </div>

        <!-- Type -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
            <select name="type" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                <option value="quiz" {{ $evaluation->type == 'quiz' ? 'selected' : '' }}>Quiz</option>
                <option value="exam" {{ $evaluation->type == 'exam' ? 'selected' : '' }}>Examen</option>
                <option value="assignment" {{ $evaluation->type == 'assignment' ? 'selected' : '' }}>Tarea</option>
                <option value="project" {{ $evaluation->type == 'project' ? 'selected' : '' }}>Proyecto</option>
            </select>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
            <textarea name="description" rows="3" 
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">{{ old('description', $evaluation->description) }}</textarea>
        </div>

        <!-- Total Score -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Puntaje Total</label>
            <input type="number" step="0.01" name="total_score" value="{{ old('total_score', $evaluation->total_score) }}" 
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
        </div>

        <!-- Date -->
        <div class="mb-8">
            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
            <input type="date" name="date" value="{{ old('date', $evaluation->date->format('Y-m-d')) }}" 
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-4 pt-4">
            <a href="{{ route('teacher.evaluations.index') }}" class="px-5 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition duration-200">
                Cancelar
            </a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-lg shadow-md transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Actualizar Evaluación
            </button>
        </div>
    </form>
</div>

</div>
 @endsection
