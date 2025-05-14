<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CAD') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <style>
            :root {
                --cad-red: 230 57 70;
                --cad-blue: 28 110 140;
                --cad-blue-light: rgb(199, 248, 255);
                --cad-orange: 240 150 45;
                --cad-brown: 142 114 88;
                --cad-green: 0 161 137;
                --cad-light: rgb(230, 244, 241);
                --cad-dark: 0 28 53;
                --css-red: rgb(230, 57, 70);
                --css-blue: rgb(28, 110, 140);
                --css-blue-light: rgb(199, 248, 255);
                --css-orange: rgb(240, 150, 45);
                --css-brown: rgb(142, 114, 88);
                --css-green: rgb(0, 161, 137);
                --css-light: rgb(230, 244, 241);
                --css-dark: rgb(0, 28, 53);
                --headings-xl: clamp(1.7rem, 2.1vw, 2.2rem);
                --headings-lg: clamp(1.4rem, 1.7vw, 1.9rem);
            }
            html {
                font-family: "Montserrat", sans-serif;
                scroll-behavior: smooth;
            }
            body {
                background-color: var(--cad-light);
                color: var(--cad-dark);
            }
            h3 {
                color: var(--css-blue);
                font-weight: 900;
                font-size: var(--headings-xl);
                text-transform: uppercase;
                text-wrap: pretty;
            }
            h4 {
                color: var(--css-orange);
                font-weight: 600;
                font-size: var(--headings-lg);
                text-wrap: pretty;
            }
            p {
                text-wrap: pretty;
            }
            p:not(:last-child) {
                margin-bottom: 0.5rem;
            }
            main {
                min-height: 80vh;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen">
            <!-- Header -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-center">
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('img/unam.svg') }}" alt="UNAM" class="h-12 w-auto">
                            <img src="{{ asset('img/cch.svg') }}" alt="CCH" class="h-12 w-auto">
                            <img src="{{ asset('img/seplan_logo.png') }}" alt="CAD" class="h-12 w-auto">
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @livewireScripts
    </body>
</html>
