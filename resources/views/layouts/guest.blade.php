<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Forzar texto blanco en todo el formulario -->
    <style>
.auth-form input {
    color: black !important;
}
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 
             bg-cover bg-center bg-fixed relative"
      style="background: url('{{ asset('images/oe2.jpg') }}') no-repeat center center fixed; background-size: cover;">

    <!-- Capa oscura -->
    <div class="absolute top-0 left-0 w-full h-full bg-black/50"></div>

    <!-- Logo -->
    

    <!-- Formulario -->
    <div class="auth-form w-full sm:max-w-md mt-6 px-6 py-4 
                bg-gray-900/80 
                backdrop-blur-md shadow-lg 
                border border-white/10 
                overflow-hidden sm:rounded-xl 
                relative z-10">
        {{ $slot }}
    </div>

</body>
</html>
