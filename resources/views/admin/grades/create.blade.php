<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Grado</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="bg-blue-600 py-5 px-6 text-center">
                <h2 class="text-xl font-bold text-white">Crear Grado</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.grades.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre del grado</label>
    <input 
        type="text" 
        name="name" 
        required 
        placeholder="Ingrese el nombre del grado"
        maxlength="50"
        pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
        title="Solo se permiten letras y espacios"
        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200"
    >
</div>


                    <div class="flex justify-between mt-8">
                        <a href="{{ route('admin.grades.index') }}" class="px-5 py-2.5 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">Cancelar</a>
                        <button type="submit" class="px-5 py-2.5 bg-green-500 hover:bg-green-600 text-white rounded-lg">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
