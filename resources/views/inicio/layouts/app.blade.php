<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Cuestionario de Actividad Docente') }}</title>
    <meta name="description" content="{{ config('app.description', 'El Cuestionario de Actividad Docente (CAD), es un instrumento que tiene como objetivo recoger la opinión de los alumnos sobre algunos indicadores de desempeño de los profesores en los cursos ordinarios') }}">
    <link rel="icon" href="{{ asset('img/favicon.svg') }}" type="svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('img/favicon.svg') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('img/favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Scripts y estilos -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


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
        .ol-number {
            list-style: none;
            counter-reset: item;
        }
        .ol-number li {
            counter-increment: item;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
        }
        .ol-number li:before {
            margin-right: 1rem;
            content: counter(item);
            background: var(--css-blue);
            color: var(--css-light);
            border-radius: 100%;
            min-width: 2rem;
            min-height: 2rem;
            text-align: center;
            font-weight: 900;
            line-height: 2rem;
            display: inline-block;
        }
        .ul-disc {
            list-style: none;
            margin-left: 1rem;
        }
        .ul-disc li {
            margin-bottom: 2rem;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
        }
        .ul-disc li:before {
            margin-right: 0.5rem;
            content: "";
            background: var(--css-blue);
            border-radius: 100%;
            min-width: 0.7rem;
            min-height: 0.7rem;
            max-width: 0.7rem;
            max-height: 0.7rem;
            margin-top: 0.3rem;
            display: inline-block;
        }
        .animate-ease-in-out {
        animation-timing-function: cubic-bezier(.4,0,.2,1);

        }
        .animate-once {
        animation-iteration-count: 1;

        }
        .animate-duration-1000, .animate-duration-\[1000ms\] {
        animation-duration: 1s;

        }
        .animate-alternate-reverse {
        animation-direction: alternate-reverse;

        }
    </style>
</head>
<body>
    <header class="bg-cyan-100 w-full py-4 z-50 top-0 hover:transition-all sticky">
        <div class="mx-auto">
            <nav class="navbar md:px-5 mx-auto flex items-center justify-between">
                <!-- logo -->
                <div class="order-0">
                    <a href="{{ route('home') }}" class="text-xl font-bold">
                        <svg class="h-10 hidden sm:block" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 321.78 144"><defs><style>.cls-1,.cls-3{fill:#4d869c;stroke-width:0}.cls-3{fill:#cde8e5}</style></defs><path class="cls-3" d="M53.15 97.74c-6.61-6.16-9.92-14.96-9.92-26.39s3.31-20.22 9.92-26.39c6.62-6.16 15.56-9.25 26.84-9.25l43.67 7.89-23 62-20.67 1.38c-11.28 0-20.22-3.08-26.84-9.25Z"/><path class="cls-1" d="M8.5 34.6c5.67-10.93 13.77-19.43 24.3-25.5C43.33 3.03 55.73 0 70 0c12.27 0 23.23 2.3 32.9 6.9 9.67 4.6 17.53 11.1 23.6 19.5s10.1 18.2 12.1 29.4H91.8c-2.13-4.67-5.17-8.3-9.1-10.9-3.93-2.6-8.43-3.9-13.5-3.9-7.47 0-13.37 2.8-17.7 8.4C47.17 55 45 62.53 45 72s2.17 17 6.5 22.6c4.33 5.6 10.23 8.4 17.7 8.4 5.07 0 9.57-1.3 13.5-3.9 3.93-2.6 6.97-6.23 9.1-10.9h46.8c-2 11.2-6.03 21-12.1 29.4-6.07 8.4-13.93 14.9-23.6 19.5-9.67 4.6-20.63 6.9-32.9 6.9-14.27 0-26.67-3.03-37.2-9.1-10.53-6.07-18.63-14.57-24.3-25.5C2.83 98.47 0 86 0 72s2.83-26.47 8.5-37.4ZM287.08 10.4c11.13 6 19.7 14.33 25.7 25s9 22.8 9 36.4-3 25.6-9 36.4c-6 10.8-14.57 19.3-25.7 25.5-11.13 6.2-24.1 9.3-38.9 9.3h-79l31-141.6h48c14.8 0 27.77 3 38.9 9Zm-19.1 84.8c5.87-5.47 8.8-13.27 8.8-23.4s-2.93-17.93-8.8-23.4c-5.87-5.46-13.8-8.2-23.8-8.2h-10.6v63.2h10.6c10 0 17.93-2.73 23.8-8.2Z"/><path d="M186.62 121.6h-47.2l-7 21.4h-46.6l51.8-141.6h51.2l51.6 141.6h-46.8l-7-21.4Zm-10.8-33.4-12.8-39.4-12.8 39.4h25.6Z" style="fill:#7ab2b2;stroke-width:0"/><path class="cls-3" d="m161.66 43.61 20 44-44.94 4.71 24.94-48.71zM270.73 97.74c6.61-6.16 9.92-14.96 9.92-26.39s-3.31-20.22-9.92-26.39c-6.62-6.16-15.56-9.25-26.84-9.25h-11.95v71.27h11.95c11.28 0 20.22-3.08 26.84-9.25Z"/><path class="cls-1" d="M127.4 27.68c5.56 8.11 9.3 17.48 11.2 28.12h-21.68"/></svg>
                    </a>
                </div>
                <ul id="nav-menu" class="navbar-nav order-1 xl:text-lg cursor-pointer flex w-auto space-x-2 xl:space-x-8 text-neutral-800 font-semibold uppercase">
                    <li><a href="{{ route('home') }}" class=" text-neutral-800 font-semibold uppercase">Inicio</a></li>
                    <li><a href="{{ route('que-es') }}" class=" text-neutral-800 font-semibold uppercase">¿Qué es?</a></li>
                    <li><a href="{{ route('preguntas-frecuentes') }}" class=" text-neutral-800 font-semibold uppercase">Preguntas</a></li>
                    <li><a href="{{ route('contacto') }}" class=" text-neutral-800 font-semibold uppercase">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    @include('inicio.partials.footer')

    @stack('scripts')
</body>
</html>
