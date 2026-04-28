<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Shahid Brothers') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">

            {{-- Shahid Brothers Branding --}}
            <div class="mb-6 text-center">
                <a href="/" wire:navigate class="inline-flex flex-col items-center gap-y-2">
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary shadow-lg">
                        <span class="text-2xl font-black text-white leading-none">SB</span>
                    </div>
                    <span class="text-lg font-extrabold text-primary tracking-tight">Shahid Brothers</span>
                    <span class="text-xs text-gray-400">Promotional Gift Items</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>

            <p class="mt-4 text-xs text-gray-400">
                &copy; {{ date('Y') }} Shahid Brothers. All rights reserved.
            </p>
        </div>
    </body>
</html>
