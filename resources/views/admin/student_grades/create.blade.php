@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Asignar notas - {{ $grade->name }}</h1>

    <form action="{{ route('admin.student_grades.store', $grade->id_grade) }}" method="POST" class="space-y-4 bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        @csrf

        <!-- Estudiante -->
        <div>
            <label class="block font-medium text-gray-700 mb-1">Estudiante:</label>
            <select name="user_id" class="border rounded p-2 w-full focus:ring-2 focus:ring-green-500" required>
                <option value="">Seleccione un estudiante</option>
                @foreach($students as $student)
                    <option value="{{ $student->id_user }}">{{ $student->name }} ({{ $student->email }})</option>
                @endforeach
            </select>
        </div>

        <!-- Materia -->
        <div>
            <label class="block font-medium text-gray-700 mb-1">Materia:</label>
            <input type="text" name="subject" class="border rounded p-2 w-full focus:ring-2 focus:ring-green-500" placeholder="Nombre de la materia" required>
        </div>

        <!-- Periodos -->
        <div class="grid grid-cols-4 gap-4">
            <div>
                <label>P1:</label>
                <input type="number" name="period1" min="0" max="100" class="border rounded p-2 w-full">
            </div>
            <div>
                <label>P2:</label>
                <input type="number" name="period2" min="0" max="100" class="border rounded p-2 w-full">
            </div>
            <div>
                <label>P3:</label>
                <input type="number" name="period3" min="0" max="100" class="border rounded p-2 w-full">
            </div>
            <div>
                <label>P4:</label>
                <input type="number" name="period4" min="0" max="100" class="border rounded p-2 w-full">
            </div>
        </div>

        <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition-all shadow-md">Asignar notas</button>
    </form>
</div>
@endsection
