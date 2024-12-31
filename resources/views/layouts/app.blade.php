<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sol Sidebar -->
        @include('layouts.partials.sidebar')

        <div class="flex-1">
            <!-- Üst Navigasyon -->
            @include('layouts.partials.topnav')

            <!-- Ana İçerik -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html> 