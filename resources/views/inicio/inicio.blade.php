@extends('inicio.layouts.app')

@section('content')
    <div id="toast-warning" class="fixed right-4 mt-5 z-50 flex items-center w-1/2 max-w-lg p-4 text-gray-500 bg-white/[.8] backdrop-blur-sm rounded-lg shadow" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
            <svg width="1em" height="1em" viewBox="0 0 16 16" data-icon="bi:patch-exclamation">
                <symbol id="ai:bi:patch-exclamation">
                    <g fill="currentColor">
                        <path d="M7.001 11a1 1 0 1 1 2 0a1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.553.553 0 0 1-1.1 0z"></path>
                        <path d="m10.273 2.513l-.921-.944l.715-.698l.622.637l.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89l.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622l.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01l-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637l-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89l-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622l-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01l.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944l-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318l-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92l-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016l.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944l1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318l.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92l.016-1.32a1.89 1.89 0 0 0-1.912-1.911z"></path>
                    </g>
                </symbol>
                <use xlink:href="#ai:bi:patch-exclamation"></use>
            </svg>
            <span class="sr-only">Alerta</span>
        </div>
        <div class="ms-3 text-sm font-normal">
            <span class="block font-bold uppercase">Fechas para completar el CAD</span>
            <span class="block">Alumnos de 6to semestre 12 al 16 de Mayo</span>
            <span class="block">Alumnos de 2do y 4to semestre 2 al 13 de Junio</span>
        </div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red text-light hover:text-gray-900 rounded-lg p-1 hover:bg-blue inline-flex items-center justify-center size-5 transition-all self-start" data-dismiss-target="#toast-warning" aria-label="Close">
            <span class="sr-only">Cerrar</span>
            <svg width="1em" height="1em" viewBox="0 0 16 16" data-icon="bi:x-circle">
                <symbol id="ai:bi:x-circle">
                    <g fill="currentColor">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8L4.646 5.354a.5.5 0 0 1 0-.708"></path>
                    </g>
                </symbol>
                <use xlink:href="#ai:bi:x-circle"></use>
            </svg>
        </button>
    </div>

    <!--<div class="bg-dark backdrop-blur-sm h-dvh block min-w-full absolute z-20 animate-fade animate-once animate-duration-[1000ms] animate-ease-in-out animate-alternate-reverse pointer-events-none">
    </div> -->

    <section class="text-pretty bg-light text-light h-dvh flex flex-col justify-center items-center lg:bg-cover lg:bg-center"
        style="{{'background-image: url(' . asset('img/bg-hero.webp') . '); background-size: cover;'}}">

        <div class="lg:h-dvh absolute z-10 min-w-full bg-gradient-to-b from-transparent from-10% via-dark/10 to-dark pointer-events-none">
        </div>
        <div class="bg-cyan-100/[.5] py-10 px-5 bg-blend-multiply backdrop-blur-sm md:rounded-lg border border-cyan-700/[.2]">
            <h1 class="text-pretty uppercase font-extrabold text-3xl lg:text-4xl text-cyan-700 border-b-2 border-cyan-700">
                Cuestionario de Actividad Docente
            </h1>
            <h2 class="text-pretty uppercase font-extrabold text-1xl lg:text-4xl text-orange-400">
                CAD
            </h2>
            <p class="text-pretty max-w-5xl mt-6 text-sm text-dark">
                Es un instrumento que tiene como objetivo “recoger la opinión de los alumnos sobre algunos indicadores de desempeño de los profesores en los cursos ordinarios”, como son: la asistencia y cumplimiento del horario asignado a cada clase; la planeación de los propósitos, aprendizajes y formas de evaluación de la asignatura.
            </p>
        </div>
        <div class="md:flex uppercase font-bold w-full md:w-1/2 text-center gap-x-10 mt-5">
            <a href="http://seplan.cch.unam.mx/reporte_resultados_cad" class="md:w-1/2 w-full bg-orange-400 hover:bg-orange-300/[.8] text-neutral-100 hover:text-neutral-800 inline-flex items-center py-8 justify-center transition duration-300 ease-in-out md:hover:scale-110 md:rounded-xl">
                Reporte de Profesores
                <svg width="1em" height="1em" viewBox="0 0 24 24" class="size-8 text-light" data-icon="line-md:person-filled">  <symbol id="ai:line-md:person-filled"><g fill="currentColor" fill-opacity="0" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path stroke-dasharray="20" stroke-dashoffset="20" d="M12 5C13.66 5 15 6.34 15 8C15 9.65685 13.6569 11 12 11C10.3431 11 9 9.65685 9 8C9 6.34315 10.3431 5 12 5z"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="20;0"></animate></path><path stroke-dasharray="36" stroke-dashoffset="36" d="M12 14C16 14 19 16 19 17V19H5V17C5 16 8 14 12 14z" opacity="0"><set attributeName="opacity" begin="0.5s" to="1"></set><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.5s" dur="0.4s" values="36;0"></animate></path><animate fill="freeze" attributeName="fill-opacity" begin="0.9s" dur="0.5s" values="0;1"></animate></g></symbol><use xlink:href="#ai:line-md:person-filled"></use>  </svg>
            </a>
            <a href="https://cad.cch.unam.mx/evaluacion" class="md:w-1/2 w-full bg-teal-600 hover:bg-teal-500/[.8] text-neutral-100 hover:text-neutral-800 inline-flex items-center py-8 justify-center transition duration-300 ease-in-out md:hover:scale-110 md:rounded-xl">
                Alumnos
                <svg width="1em" height="1em" viewBox="0 0 24 24" class="size-8 text-light" data-icon="line-md:person-filled">  <symbol id="ai:line-md:person-filled"><g fill="currentColor" fill-opacity="0" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path stroke-dasharray="20" stroke-dashoffset="20" d="M12 5C13.66 5 15 6.34 15 8C15 9.65685 13.6569 11 12 11C10.3431 11 9 9.65685 9 8C9 6.34315 10.3431 5 12 5z"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="20;0"></animate></path><path stroke-dasharray="36" stroke-dashoffset="36" d="M12 14C16 14 19 16 19 17V19H5V17C5 16 8 14 12 14z" opacity="0"><set attributeName="opacity" begin="0.5s" to="1"></set><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.5s" dur="0.4s" values="36;0"></animate></path><animate fill="freeze" attributeName="fill-opacity" begin="0.9s" dur="0.5s" values="0;1"></animate></g></symbol><use xlink:href="#ai:line-md:person-filled"></use>  </svg>
            </a>
        </div>
    </section>
@endsection
