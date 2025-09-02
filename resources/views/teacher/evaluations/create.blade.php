@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl"> <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 border border-gray-100"> <!-- Header --> <div class="mb-8 text-center"> <h1 class="text-3xl font-bold text-gray-900 mb-2">Crear Nueva Evaluación</h1> <p class="text-gray-600">Complete la información para crear una nueva evaluación</p> </div>


    <!-- Form -->
    <form action="{{ route('teacher.evaluations.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Subject Selection -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Materia</label>
            <select name="subject_id" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                @foreach($subjects as $subject)
                <option value="{{ $subject->id_subject }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Grade Selection -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Grado</label>
            <select name="grade_id" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                @foreach($grades as $grade)
                <option value="{{ $grade->id_grade }}">{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Type Selection -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de Evaluación</label>
            <select name="type" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                <option value="quiz">Quiz</option>
                <option value="exam">Examen</option>
                <option value="assignment">Tarea</option>
                <option value="project">Proyecto</option>
            </select>
        </div>

        <!-- Title -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Título</label>
            <input type="text" name="title" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" placeholder="Ingrese el título de la evaluación">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
            <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" placeholder="Describa los detalles de la evaluación"></textarea>
        </div>

        <!-- Total Score -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nota Máxima</label>
            <input type="number" step="0.01" name="total_score" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" placeholder="Ej: 20.00">
        </div>

        <!-- Date -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
            <input type="date" name="date" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-4 pt-6">
            <a href="{{ route('teacher.evaluations.index') }}" class="px-5 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition duration-200">
                Cancelar
            </a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-lg shadow-md transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Guardar Evaluación
            </button>
        </div>
    </form>
</div>

</div> 
@endsection
