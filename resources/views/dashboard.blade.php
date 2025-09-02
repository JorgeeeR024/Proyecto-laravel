<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-lg font-semibold">
                    {{-- Saludo personalizado --}}
                    @php
                        $rol = ucfirst(Auth::user()->role); // primera letra mayúscula
                        $nombre = Auth::user()->name;
                    @endphp

                    Bienvenido, <span class="text-blue-500">{{ $nombre }}</span>  
                    @if($rol === 'Admin')
                        🛠️ (Administrador)
                    @elseif($rol === 'Docente')
                        📚 (Docente)
                    @elseif($rol === 'Estudiante')
                        🎓 (Estudiante)
                    @else
                        👤 ({{ $rol }})
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
