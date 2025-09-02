<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Nota</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4 max-w-2xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Editar Nota</h1>
            <p class="text-gray-600 mt-2">Actualiza las calificaciones del estudiante</p>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <form class="space-y-6">
                <!-- Información del estudiante y materia -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estudiante</label>
                        <div class="p-2 bg-gray-50 border border-gray-200 rounded text-gray-800">
                            María Rodríguez
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Materia</label>
                        <div class="p-2 bg-gray-50 border border-gray-200 rounded text-gray-800">
                            Matemáticas
                        </div>
                    </div>
                </div>
                
                <!-- Calificaciones por período -->
                <div class="border-t border-gray-100 pt-4">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Calificaciones por Período</h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Período 1 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">P1</label>
                            <input type="number" value="85" min="0" max="100" 
                                class="w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <!-- Período 2 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">P2</label>
                            <input type="number" value="78" min="0" max="100" 
                                class="w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <!-- Período 3 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">P3</label>
                            <input type="number" value="92" min="0" max="100" 
                                class="w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <!-- Período 4 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">P4</label>
                            <input type="number" value="88" min="0" max="100" 
                                class="w-full p-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
                
                <!-- Botones de acción -->
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded shadow-sm">
                        Actualizar Nota
                    </button>
                    <button type="button" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded shadow-sm">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>