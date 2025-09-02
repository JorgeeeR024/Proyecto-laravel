@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">✨ Editar Evaluación ✨</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.evaluations.update', $evaluation) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <label class="block">
            <span class="text-gray-700">Usuario</span>
            <input type="text" value="{{ $evaluation->user->name }}" disabled class="border rounded px-3 py-2 w-full bg-gray-100">
        </label>

        <label class="block">
            <span class="text-gray-700">Grado</span>
            <input type="text" value="{{ $evaluation->grade->name }}" disabled class="border rounded px-3 py-2 w-full bg-gray-100">
        </label>

        <label class="block">
            <span class="text-gray-700">Materia</span>
            <input type="text" value="{{ $evaluation->subject->name }}" disabled class="border rounded px-3 py-2 w-full bg-gray-100">
        </label>

        <label class="block">
            <span class="text-gray-700">Tipo</span>
            <input type="text" value="{{ ucfirst($evaluation->type) }}" disabled class="border rounded px-3 py-2 w-full bg-gray-100">
        </label>

        <label class="block">
            <span class="text-gray-700">Puntaje</span>
            <input type="number" name="score" value="{{ $evaluation->score }}" class="border rounded px-3 py-2 w-full" min="0" max="100">
        </label>

        <label class="block">
            <span class="text-gray-700">Comentarios</span>
            <textarea name="comments" class="border rounded px-3 py-2 w-full" rows="3">{{ $evaluation->comments }}</textarea>
        </label>

        <div class="flex justify-between">
            <a href="{{ route('admin.evaluations.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Actualizar</button>
        </div>
    </form>
</div>
@endsection
