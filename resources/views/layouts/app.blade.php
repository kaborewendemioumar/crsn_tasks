<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CRSN Tasks') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased bg-slate-100 text-slate-800">
        @include('components.back-button')
        <div class="min-h-screen bg-slate-100">

            @include('layouts.navigation')

            @include('components.back-button')

            <main class="py-10">

                @isset($header)
                    <header class="mx-auto mb-8 max-w-7xl rounded-3xl border border-slate-200 bg-white px-4 py-6 shadow-lg sm:px-6 lg:px-8">
                        {{ $header }}
                    </header>
                @endisset

                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                    <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-xl">

                        {{ $slot }}

                    </div>

                </div>

            </main>

        </div>

    </body>
</html>