<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Registro de Compras') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">
    <main class="mx-auto flex min-h-screen max-w-5xl flex-col justify-center px-6 py-12">
        <div class="max-w-2xl">
            <p class="text-sm font-semibold uppercase tracking-wide text-gray-500">Registro de Compras</p>
            <h1 class="mt-3 text-4xl font-semibold tracking-tight sm:text-5xl">Control simple para tus compras.</h1>
            <p class="mt-4 text-lg text-gray-600">Registra compras, revisa totales y exporta tus datos a Excel desde una aplicacion Laravel ligera.</p>
            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex justify-center rounded-md bg-[#0A4D2E] px-5 py-3 text-sm font-medium text-white hover:bg-[#0F623D]">Ir al panel</a>
                @else
                    <a href="{{ route('register') }}" class="inline-flex justify-center rounded-md bg-[#0A4D2E] px-5 py-3 text-sm font-medium text-white hover:bg-[#0F623D]">Crear cuenta</a>
                    <a href="{{ route('login') }}" class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-5 py-3 text-sm font-medium text-gray-800 hover:bg-gray-100">Iniciar sesion</a>
                @endauth
            </div>
        </div>
    </main>
</body>
</html>
