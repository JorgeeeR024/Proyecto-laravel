@extends('layouts.app')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Dashboard Student</h2>
    <p>Bienvenido, {{ auth()->user()->name }}. Aquí verás tus tareas pendientes y calificaciones.</p>
</div>
@endsection
