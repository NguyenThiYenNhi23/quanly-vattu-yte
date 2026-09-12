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
        <div class="relative min-h-screen overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(34,211,238,0.22),_transparent_25%),radial-gradient(circle_at_bottom_right,_rgba(16,185,129,0.2),_transparent_28%),linear-gradient(135deg,#f0fdfd_0%,#eff6ff_38%,#f8fafc_100%)] px-4 py-10 sm:flex sm:items-center sm:justify-center">
            <div class="absolute inset-0 opacity-70 [background-image:linear-gradient(rgba(148,163,184,0.08)_1px,transparent_1px),linear-gradient(90deg,rgba(148,163,184,0.08)_1px,transparent_1px)] [background-size:36px_36px]"></div>

            <div class="relative w-full max-w-md">
                <a href="{{ route('dashboard') }}" class="mb-7 flex items-center justify-center gap-3 text-slate-800">
                    <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-500 via-sky-500 to-emerald-500 shadow-xl shadow-cyan-300/50 ring-4 ring-white/80">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" class="h-7 w-7 text-white">
                            <path d="M12 4.5v15M4.5 12h15" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <rect x="5.5" y="5.5" width="13" height="13" rx="3" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M8.6 15.3c.8 1.2 2.1 1.9 3.4 1.9 1.7 0 3.4-.9 4.3-2.4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span>
                        <span class="block text-xl font-black leading-tight tracking-tight text-slate-900">Quản lý vật tư</span>
                        <span class="block text-[0.7rem] font-semibold uppercase tracking-[0.22em] text-cyan-700">Thiết bị &amp; y tế</span>
                    </span>
                </a>

                <div class="rounded-3xl border border-sky-100/80 bg-white/90 p-7 shadow-[0_20px_60px_rgba(14,116,144,0.15)] backdrop-blur sm:p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
