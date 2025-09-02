<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes del grado {{ $grade->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen p-6">
    <div class="max-w-4xl mx-auto">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Estudiantes en {{ $grade->name }}</h1>
            <a href="{{ route('admin.grades.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">⬅ Volver</a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg mb-6 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nombre</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Email</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($grade->users as $student)
                        <tr>
                            <td class="px-6 py-4">{{ $student->name }}</td>
                            <td class="px-6 py-4">{{ $student->email }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-gray-500 text-center">No hay estudiantes asignados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-bold mb-4">Asignar estudiante</h2>
            <form action="{{ route('admin.grades.assignStudent', $grade->id_grade) }}" method="POST" class="flex gap-3 items-center">
                @csrf
                <select name="student_id" required class="border border-gray-300 rounded px-3 py-2 w-full">
                    <option value="">-- Seleccione un estudiante --</option>
                    @foreach($studentsWithoutGrade as $student)
                        <option value="{{ $student->id_user }}">{{ $student->name }} ({{ $student->email }})</option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Asignar</button>
            </form>
        </div>
    </div>
</body>
</html>
