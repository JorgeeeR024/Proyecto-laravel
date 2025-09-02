@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Agregar Nota</h1>

    <form action="{{ route('teacher.student_grades.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Estudiante:</label>
            <select name="user_id" class="border rounded p-2 w-full" required>
                <option value="">Selecciona un estudiante</option>
                @foreach($students as $student)
                <option value="{{ $student->id_user }}">{{ $student->name }} ({{ $student->email }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium">Materia:</label>
            <input type="text" name="subject" class="border rounded p-2 w-full" required>
        </div>

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

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Guardar Nota</button>
    </form>
</div>
@endsection