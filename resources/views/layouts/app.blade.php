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
    <body class="font-sans antialiased bg-slate-950 text-slate-100">
        <div class="min-h-screen bg-slate-950">
            @include('layouts.navigation')

            <div class="relative overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(34,197,94,0.18),_transparent_25%),radial-gradient(circle_at_bottom_right,_rgba(59,130,246,0.14),_transparent_30%)]"></div>
                <div class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-slate-900/80 to-transparent"></div>
                <main class="relative py-10">
                    @isset($header)
                        <header class="mx-auto mb-8 max-w-7xl rounded-3xl border border-white/10 bg-slate-900/80 px-4 py-6 shadow-2xl shadow-slate-950/40 backdrop-blur sm:px-6 lg:px-8">
                            {{ $header }}
                        </header>
                    @endisset

                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="rounded-[2rem] bg-slate-900/80 p-6 shadow-2xl shadow-slate-950/50 ring-1 ring-white/10 backdrop-blur">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>

</html>
