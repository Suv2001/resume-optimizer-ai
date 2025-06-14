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
        @if(app()->environment('testing'))
            <!-- Skip Vite in testing environment -->
            <style>
                .font-sans { font-family: ui-sans-serif, system-ui, sans-serif; }
                .antialiased { -webkit-font-smoothing: antialiased; }
                .min-h-screen { min-height: 100vh; }
                .bg-gray-100 { background-color: rgb(243 244 246); }
                .bg-white { background-color: rgb(255 255 255); }
                .shadow { box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1); }
                .max-w-7xl { max-width: 80rem; }
                .mx-auto { margin-left: auto; margin-right: auto; }
                .py-6 { padding-top: 1.5rem; padding-bottom: 1.5rem; }
                .px-4 { padding-left: 1rem; padding-right: 1rem; }
                .sm\:px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
                .lg\:px-8 { padding-left: 2rem; padding-right: 2rem; }
            </style>
        @else
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
