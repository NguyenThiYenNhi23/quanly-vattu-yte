<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="relative min-h-screen overflow-hidden bg-slate-950 px-4 py-10 sm:flex sm:items-center sm:justify-center">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(14,165,233,0.3),_transparent_38%),radial-gradient(circle_at_bottom_left,_rgba(16,185,129,0.22),_transparent_35%)]"></div>

            <div class="relative w-full max-w-md">
                <a href="{{ route('dashboard') }}" class="mb-7 flex items-center justify-center gap-3 text-white">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-400 text-lg font-bold text-slate-950 shadow-lg shadow-cyan-500/30">+</span>
                    <span>
                        <span class="block text-lg font-semibold leading-tight">Quản lý vật tư</span>
                        <span class="block text-xs text-slate-300">Thiết bị & vật tư y tế</span>
                    </span>
                </a>

                <div class="rounded-2xl border border-white/15 bg-white p-7 shadow-2xl shadow-slate-950/40 sm:p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
