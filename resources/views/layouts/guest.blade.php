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

    <body class="font-sans text-gray-900 antialiased">

        @include('components.back-button')

        <div class="min-h-screen flex flex-col sm:justify-center items-center
                    pt-6 sm:pt-0 bg-slate-100">

            <div>
                <a href="/">
                    <x-application-logo class="w-32 h-32 fill-current text-green-600" />
                </a>
            </div>

            @include('components.back-button')

            <div class="w-full sm:max-w-md mt-6 px-6 py-4
                        bg-white shadow-xl border border-slate-200
                        overflow-hidden sm:rounded-2xl">

                {{ $slot }}

            </div>

        </div>

    </body>
</html>