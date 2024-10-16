<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth bg-gray-100 dark:bg-gray-900">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Solution for Softwares">
        <meta name="author" content="Vitor Maia">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>{{ config('app.name') }} - Soluções para o mercado</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ url(asset('./img/logo.jpg')) }}">
        @vite(['resources/js/app.js', 'resources/sass/app.scss'])
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        @livewireStyles
    </head>
    <body class="min-h-screen" x-data="{ menuVisibility: false, modalSide: false, modalCenter: false}">

        @if(Auth::check())
            <div class="flex sm:hidden">
                <x-side-bar></x-side-bar>
            </div>
        @endif

        @if(Auth::check())
            <x-nav-bar/>
        @endif

        <main>
            {{ $slot }}
        </main>

{{--        @livewire('components.modal')--}}
        @livewire('components.toast')
        @livewireScripts
    </body>
</html>
