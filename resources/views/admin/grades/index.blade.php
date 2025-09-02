
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Grados</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen p-6">
    <div class="max-w-5xl mx-auto">
        <!-- Header con título y botón -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-graduation-cap mr-3 text-primary-600"></i> Lista de Grados
            </h1>
            <a href="{{ route('admin.grades.create') }}" class="flex items-center px-5 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-plus-circle mr-2"></i> Crear Grado
            </a>
        </div>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-green-500"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Contador de grados -->
        <div class="mb-4 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
            <p class="text-sm text-gray-600">
                Mostrando <span class="font-semibold">{{ count($grades) }}</span> grados registrados
            </p>
        </div>

        <!-- Tabla de grados -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nombre del Grado</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($grades as $grade)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $grade->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-wrap items-center gap-2">
                                    <a href="{{ route('admin.grades.students', $grade->id_grade) }}" class="inline-flex items-center px-3 py-2 bg-green-100 text-green-800 text-sm font-medium rounded-lg hover:bg-green-200 transition duration-200">
                                        <i class="fas fa-users mr-2"></i> Estudiantes
                                    </a>
                                    <a href="{{ route('admin.grades.edit', $grade->id_grade) }}" class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-800 text-sm font-medium rounded-lg hover:bg-blue-200 transition duration-200">
                                        <i class="fas fa-edit mr-2"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.grades.destroy', $grade->id_grade) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este grado?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-100 text-red-800 text-sm font-medium rounded-lg hover:bg-red-200 transition duration-200">
                                            <i class="fas fa-trash-alt mr-2"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <i class="fas fa-inbox text-4xl mb-3"></i>
                                    <p class="text-lg">No hay grados registrados</p>
                                    <p class="text-sm mt-1">Comienza creando tu primer grado</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Efecto de hover mejorado para botones
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('a, button');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-1px)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>
@endsection
