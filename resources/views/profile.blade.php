@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold">Mi Perfil</h1>
<p>Nombre: {{ Auth::user()->name }}</p>
<p>Email: {{ Auth::user()->email }}</p>
<p>Rol: {{ Auth::user()->role }}</p>
@endsection
