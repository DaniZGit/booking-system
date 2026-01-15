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
    </head>
    <body class="font-sans antialiased w-full">
        <div class="min-h-screen flex flex-col bg-white">
            <!-- Page Heading -->
            <div class="bg-gray-200">
                <header class="max-w-7xl mx-auto p-4">
                    <livewire:layout.header />
                </header>
            </div>

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto w-full grow p-4 flex ">
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            <div class="bg-gray-600 ">
                <footer class="max-w-7xl mx-auto p-4 py-4 text-white text-center">
                    <livewire:layout.footer />
                </footer>
            </div>
        </div>
    </body>
</html>
