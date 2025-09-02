@extends('layouts.app')

@section('content')

<div class="py-8 px-6 max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-3">📊 Gráficas de Usuarios</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Gráfico de Roles -->
        <div class="bg-white rounded-2xl shadow-lg p-6 transition-transform transform hover:scale-105">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Usuarios por Rol</h2>
            <canvas id="rolesChart" class="w-full h-64"></canvas>
        </div>

        <!-- Gráfico de Grados -->
        <div class="bg-white rounded-2xl shadow-lg p-6 transition-transform transform hover:scale-105">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Usuarios por Grado</h2>
            <canvas id="gradesChart" class="w-full h-64"></canvas>
        </div>
    </div>

    <!-- Total -->
    <div class="mt-8 bg-white rounded-2xl shadow-lg p-6 flex items-center justify-between transition-shadow hover:shadow-2xl">
        <div>
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Total de Usuarios</h2>
            <p class="text-4xl font-bold text-indigo-600">{{ $totalUsers }}</p>
        </div>
        <div class="text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de Roles
    const rolesData = @json($roles);
    new Chart(document.getElementById('rolesChart'), {
        type: 'pie',
        data: {
            labels: Object.keys(rolesData),
            datasets: [{
                data: Object.values(rolesData),
                backgroundColor: ['#6366F1', '#10B981', '#F59E0B', '#EF4444'],
                borderColor: '#ffffff',
                borderWidth: 2
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: '#4B5563', font: { size: 14 } }
                }
            }
        }
    });

    // Gráfico de Grados
    const gradesData = @json($grades);
    new Chart(document.getElementById('gradesChart'), {
        type: 'bar',
        data: {
            labels: Object.keys(gradesData),
            datasets: [{
                label: 'Usuarios',
                data: Object.values(gradesData),
                backgroundColor: '#3B82F6',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                x: { ticks: { color: '#4B5563', font: { size: 14 } } },
                y: { ticks: { color: '#4B5563', font: { size: 14 }, stepSize: 1 } }
            }
        }
    });
</script>

@endsection
