@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $grade->name }} - Gestión de Grado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto p-6 max-w-4xl">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-3xl font-bold text-indigo-700 mb-2">{{ $grade->name }}</h1>
            <p class="text-gray-600">Panel de gestión del grado educativo</p>
        </div>

        <!-- Estudiantes Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">
                    <i class="fas fa-users text-indigo-500 mr-2"></i>Estudiantes
                </h2>
                <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                    {{ $grade->students->count() }} estudiantes
                </span>
            </div>
            
            @if($grade->students->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grade->students as $student)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $student->name }}</td>
                                    <td class="px-4 py-3">{{ $student->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-user-slash text-gray-300 text-4xl mb-3"></i>
                    <p class="text-gray-500">No hay estudiantes en este grado.</p>
                </div>
            @endif
        </div>

        <!-- Materiales Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">
                    <i class="fas fa-book-open text-indigo-500 mr-2"></i>Materiales
                </h2>
                <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                    {{ $grade->materials->count() }} materiales
                </span>
            </div>
            
            @if($grade->materials->count())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($grade->materials as $material)
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex justify-between items-start">
                                <h3 class="font-medium text-gray-900">{{ $material->name }}</h3>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded">
                                    {{ $material->type }}
                                </span>
                            </div>
                            <div class="mt-3">
                                @if($material->type === 'Link')
                                    <a href="{{ $material->file }}" target="_blank" 
                                       class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                                        <i class="fas fa-external-link-alt mr-1"></i> Abrir enlace
                                    </a>
                                @else
                                    <a href="{{ asset('storage/'.$material->file) }}" target="_blank" 
                                       class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                                        <i class="fas fa-download mr-1"></i> Descargar
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-folder-open text-gray-300 text-4xl mb-3"></i>
                    <p class="text-gray-500">No hay materiales en este grado.</p>
                </div>
            @endif
        </div>

        <!-- Add Material Form -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                <i class="fas fa-plus-circle text-indigo-500 mr-2"></i>Agregar Material
            </h2>
            
            @if ($errors->any())
            <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <strong>Por favor corrige los siguientes errores:</strong>
                </div>
                <ul class="mt-1 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
                <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-4 flex items-center">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('teacher.gestion_grades.materials.store', $grade->id_grade) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre del material</label>
                    <input type="text" id="name" name="name" placeholder="Ingresa el nombre del material" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                
                <div>
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900">Tipo de material</label>
                    <select id="type" name="type" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Selecciona un tipo</option>
                        <option value="PDF">PDF</option>
                        <option value="Video">Video</option>
                        <option value="Link">Enlace</option>
                    </select>
                </div>
                
                <div id="file-field">
                    <label for="file" class="block mb-2 text-sm font-medium text-gray-900">Archivo</label>
                    <input type="file" id="file" name="file" accept=".pdf,.mp4" 
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                </div>
                
                <div id="url-field" class="hidden">
                    <label for="url" class="block mb-2 text-sm font-medium text-gray-900">URL</label>
                    <input type="url" id="url" name="url" placeholder="https://ejemplo.com" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i> Agregar Material
                </button>
            </form>
        </div>
    </div>

    <script>
        // Mostrar/ocultar campos según el tipo seleccionado
        document.getElementById('type').addEventListener('change', function() {
            const type = this.value;
            const fileField = document.getElementById('file-field');
            const urlField = document.getElementById('url-field');
            
            if (type === 'Link') {
                fileField.classList.add('hidden');
                urlField.classList.remove('hidden');
            } else {
                fileField.classList.remove('hidden');
                urlField.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
@endsection