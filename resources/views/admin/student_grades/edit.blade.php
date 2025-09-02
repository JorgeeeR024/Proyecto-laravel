<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Nota</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen p-6">
    <div class="max-w-md mx-auto bg-white shadow rounded-lg p-6">
        <h1 class="text-xl font-bold mb-4">
            Editar nota de {{ $studentGrade->student->name }} en {{ $studentGrade->grade->name }}
        </h1>

        <form action="{{ route('admin.student_grades.update', $studentGrade->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" value="{{ $studentGrade->subject }}" readonly class="border px-3 py-2 rounded bg-gray-100">
            <input type="hidden" name="subject" value="{{ $studentGrade->subject }}">

            <input type="number" name="period1" value="{{ $studentGrade->period1 }}" placeholder="P1" min="0" max="100" class="border px-3 py-2 rounded mt-2 w-full">
            <input type="number" name="period2" value="{{ $studentGrade->period2 }}" placeholder="P2" min="0" max="100" class="border px-3 py-2 rounded mt-2 w-full">
            <input type="number" name="period3" value="{{ $studentGrade->period3 }}" placeholder="P3" min="0" max="100" class="border px-3 py-2 rounded mt-2 w-full">
            <input type="number" name="period4" value="{{ $studentGrade->period4 }}" placeholder="P4" min="0" max="100" class="border px-3 py-2 rounded mt-2 w-full">

            <div class="flex justify-between mt-4">
                <a href="{{ route('admin.student_grades.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Actualizar</button>
            </div>
        </form>
    </div>
</body>
</html>
