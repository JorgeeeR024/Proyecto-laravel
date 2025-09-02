@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Nueva Evaluación</h1>

    <form action="{{ route('admin.evaluations.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf

        <!-- Selección de estudiante -->
        <div>
            <label class="block mb-1 font-semibold">Estudiante:</label>
            <select name="user_id" class="border px-3 py-2 rounded w-full" required>
                <option value="">-- Seleccionar estudiante --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id_user }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Selección de grado -->
        <div>
            <label class="block mb-1 font-semibold">Grado:</label>
            <select name="grade_id" class="border px-3 py-2 rounded w-full" required>
                <option value="">-- Seleccionar grado --</option>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id_grade }}">{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Materia -->
        <div>
            <label class="block mb-1 font-semibold">Materia:</label>
            <select name="subject_id" class="border px-3 py-2 rounded w-full" required>
                <option value="">-- Seleccionar materia --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id_subject }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Evaluaciones por tipo -->
        <div>
            <label class="block mb-1 font-semibold">Autoevaluación (self):</label>
            <input type="number" name="score[self]" min="0" max="100" placeholder="Puntaje" class="border px-3 py-2 rounded w-full" required>
            <textarea name="comments[self]" placeholder="Comentarios" class="border px-3 py-2 rounded w-full mt-1"></textarea>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Coevaluación (peer):</label>
            <input type="number" name="score[peer]" min="0" max="100" placeholder="Puntaje" class="border px-3 py-2 rounded w-full" required>
            <textarea name="comments[peer]" placeholder="Comentarios" class="border px-3 py-2 rounded w-full mt-1"></textarea>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Evaluación del profesor (teacher):</label>
            <input type="number" name="score[teacher]" min="0" max="100" placeholder="Puntaje" class="border px-3 py-2 rounded w-full" required>
            <textarea name="comments[teacher]" placeholder="Comentarios" class="border px-3 py-2 rounded w-full mt-1"></textarea>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.evaluations.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Crear Evaluaciones</button>
        </div>
    </form>
</div>
@endsection
