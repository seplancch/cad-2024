<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
        @if (session('error'))
            <div class="alert flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300">
                <div class="alert-icon flex items-center bg-red-100 border-2 border-red-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
                    <span class="text-red-500">
                        <svg fill="currentColor"
                             viewBox="0 0 20 20"
                             class="h-6 w-6">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </div>
                <div class="alert-content ml-4">
                    <div class="alert-title font-semibold text-lg text-red-800">
                        Error
                    </div>
                    <div class="alert-description text-sm text-red-600">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="alert flex flex-row items-center bg-green-200 p-5 rounded border-b-2 border-green-300">
                <div class="alert-icon flex items-center bg-green-100 border-2 border-green-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
                    <span class="text-green-500">
                        <svg fill="currentColor"
                             viewBox="0 0 20 20"
                             class="h-6 w-6">
                            <path fill-rule="evenodd"
                                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </div>
                <div class="alert-content ml-4">
                    <div class="alert-title font-semibold text-lg text-green-800">
                        Éxito
                    </div>
                    <div class="alert-description text-sm text-green-600">
                        {{session('success')}}
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-1">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-lg border border-gray-100 p-6 shadow-md shadow-black/5">
                <div class="flex flex-col space-y-4">
                    <!-- Encabezado -->
                    <div class="border-b pb-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-bold text-gray-800">Cuestionario CAD {{$periodoActual}}</h2>
                            @php
                                $totalGrupos = count($inscripciones);
                                $completados = $inscripciones->where('estado', 1)->count();
                                $enProceso = $inscripciones->where('estado', 0)->where('updated_at', '!=', null)->count();
                                $sinIniciar = $inscripciones->where('estado', 0)->where('updated_at', null)->count();
                                $porcentaje = $totalGrupos > 0 ? round(($completados / $totalGrupos) * 100) : 0;
                            @endphp
                            <div class="flex items-center">
                                @if($completados == $totalGrupos && $totalGrupos > 0)
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                        Completado ({{ $porcentaje }}%)
                                    </span>
                                @elseif($enProceso > 0 || $sinIniciar > 0)
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        En proceso ({{ $porcentaje }}%)
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Sin iniciar (0%)
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Información del Alumno -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Nombre</p>
                                    <p class="font-medium text-gray-900">{{$usuario->name}}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 01-3.476.383.39.39 0 00-.297.17l-2.755 4.133a.75.75 0 01-1.248 0l-2.755-4.133a.39.39 0 00-.297-.17 48.9 48.9 0 01-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97zM6.75 8.25a.75.75 0 01.75-.75h9a.75.75 0 010 1.5h-9a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H7.5z" clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">No. Cuenta</p>
                                    <p class="font-medium text-gray-900">{{$usuario->alumno->numero_cuenta}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
                                    <path d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z" />
                                    <path d="M4.462 19.462c.42-.419.753-.89 1-1.394.453.213.902.434 1.347.661a6.743 6.743 0 01-1.286 1.794.75.75 0 11-1.06-1.06z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Semestre</p>
                                    <p class="font-medium text-gray-900">{{$semestre}}°</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM8.547 4.505a8.25 8.25 0 1011.672 8.214l-.997.997a.75.75 0 01-1.06 0l-.997-.997A8.25 8.25 0 008.547 4.505zM12 7.5a.75.75 0 01.75.75v2.25H15a.75.75 0 010 1.5h-2.25V15a.75.75 0 01-1.5 0v-2.25H9a.75.75 0 010-1.5h2.25V8.25A.75.75 0 0112 7.5z" clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Plantel</p>
                                    <p class="font-medium text-gray-900">{{$usuario->alumno->plantel[0]->nombre}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Barra de Progreso -->
                    <div class="pt-4">
                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                            <span>Progreso de Evaluaciones</span>
                            <span>{{ $porcentaje }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="h-2.5 rounded-full {{ $porcentaje == 100 ? 'bg-green-600' : ($porcentaje > 0 ? 'bg-yellow-500' : 'bg-gray-400') }}" 
                                 style="width: {{ $porcentaje }}%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>{{ $completados }} completadas</span>
                            <span>{{ $totalGrupos }} total</span>
                        </div>
                    </div>
                </div>
            </div>
            @if($semestre != 6)
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                <div class="flex justify-between mb-4">
                    <div>
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-semibold">Cuestionario de opinión sobre los Servicios de la UNAM</div>
                            <div class="p-1 rounded bg-emerald-500/10 text-emerald-500 text-[12px] font-semibold leading-none ml-2">+100%</div>
                        </div>
                        <div class="text-sm font-medium text-gray-400">
                            Para poder completar tu evaluacion del CAD deberas tambien completar la evaluacion de los servicios de la UNAM.
                        </div>
                    </div>
                </div>

                <div class="flex items-center text-sm font-medium text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2">Incompleto</span>
                </div>

                <a href="http://localhost/dashboard/report" type="button" class="w-full px-3 py-1.5 mt-4 text-base font-medium text-white flex items-center justify-center bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path d="M21.721 12.752a9.711 9.711 0 0 0-.945-5.003 12.754 12.754 0 0 1-4.339 2.708 18.991 18.991 0 0 1-.214 4.772 17.165 17.165 0 0 0 5.498-2.477ZM14.634 15.55a17.324 17.324 0 0 0 .332-4.647c-.952.227-1.945.347-2.966.347-1.021 0-2.014-.12-2.966-.347a17.515 17.515 0 0 0 .332 4.647 17.385 17.385 0 0 0 5.268 0ZM9.772 17.119a18.963 18.963 0 0 0 4.456 0A17.182 17.182 0 0 1 12 21.724a17.18 17.18 0 0 1-2.228-4.605ZM7.777 15.23a18.87 18.87 0 0 1-.214-4.774 12.753 12.753 0 0 1-4.34-2.708 9.711 9.711 0 0 0-.944 5.004 17.165 17.165 0 0 0 5.498 2.477ZM21.356 14.752a9.765 9.765 0 0 1-7.478 6.817 18.64 18.64 0 0 0 1.988-4.718 18.627 18.627 0 0 0 5.49-2.098ZM2.644 14.752c1.682.971 3.53 1.688 5.49 2.099a18.64 18.64 0 0 0 1.988 4.718 9.765 9.765 0 0 1-7.478-6.816ZM13.878 2.43a9.755 9.755 0 0 1 6.116 3.986 11.267 11.267 0 0 1-3.746 2.504 18.63 18.63 0 0 0-2.37-6.49ZM12 2.276a17.152 17.152 0 0 1 2.805 7.121c-.897.23-1.837.353-2.805.353-.968 0-1.908-.122-2.805-.353A17.151 17.151 0 0 1 12 2.276ZM10.122 2.43a18.629 18.629 0 0 0-2.37 6.49 11.266 11.266 0 0 1-3.746-2.504 9.754 9.754 0 0 1 6.116-3.985Z" />
                    </svg>
                    <span class="ml-2">Contestar servicios de la UNAM</span>
                </a>
            </div>
            @endif
        </div>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
            <!-- Sección de Progreso de Evaluaciones -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-4 mb-4">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Progreso de Evaluaciones</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @php
                        $totalGrupos = count($inscripciones);
                        $completados = $inscripciones->where('estado', 1)->count();
                        $enProceso = $inscripciones->where('estado', 0)->where('updated_at', '!=', null)->count();
                        $sinIniciar = $inscripciones->where('estado', 0)->where('updated_at', null)->count();
                        $porcentaje = $totalGrupos > 0 ? round(($completados / $totalGrupos) * 100) : 0;
                    @endphp

                    <div class="bg-gray-100 p-4 rounded-lg text-center">
                        <div class="text-2xl font-bold text-gray-400">{{ $sinIniciar }}</div>
                        <div class="text-sm text-gray-600">Sin Iniciar</div>
                    </div>

                    <div class="bg-yellow-100 p-4 rounded-lg text-center">
                        <div class="text-2xl font-bold text-yellow-600">{{ $enProceso }}</div>
                        <div class="text-sm text-yellow-700">En Proceso</div>
                    </div>

                    <div class="bg-green-100 p-4 rounded-lg text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $completados }}</div>
                        <div class="text-sm text-green-700">Completados</div>
                    </div>

                    <div class="bg-blue-100 p-4 rounded-lg text-center">
                        <div class="text-2xl font-bold text-blue-600">{{ $porcentaje }}%</div>
                        <div class="text-sm text-blue-700">Progreso Total</div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-6 py-4 border-b border-gray-100">
                    <div class="flex flex-col space-y-4">
                        <!-- Aviso de evaluación integrado -->
                        <div class="flex items-center p-3 bg-blue-50 rounded-lg border border-blue-100">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-blue-800">
                                    ¡Evalúa a tus profesores y ayúdanos a mejorar la calidad de la enseñanza!
                                </p>
                                <p class="mt-1 text-sm text-blue-600">
                                    Haz clic en el nombre del profesor para realizar tu evaluación.
                                </p>
                            </div>
                        </div>

                        <!-- Encabezado con título y contadores -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Profesores a Evaluar</h2>
                                <p class="text-sm text-gray-600 mt-1">Total de profesores: {{ count($inscripciones) }}</p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div>
                                    <span class="text-sm text-gray-600">{{ $completados }} Completados</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-2 h-2 rounded-full bg-yellow-500 mr-2"></div>
                                    <span class="text-sm text-gray-600">{{ $enProceso }} En Proceso</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-2 h-2 rounded-full bg-gray-400 mr-2"></div>
                                    <span class="text-sm text-gray-600">{{ $sinIniciar }} Sin Iniciar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col" class="group px-6 py-3 text-left">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Profesor</span>
                                        <svg class="h-4 w-4 text-gray-400 opacity-0 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" class="group px-6 py-3 text-left">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Asignatura</span>
                                        <svg class="h-4 w-4 text-gray-400 opacity-0 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" class="group px-6 py-3 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Grupo</span>
                                        <svg class="h-4 w-4 text-gray-400 opacity-0 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" class="group px-6 py-3 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Sección</span>
                                        <svg class="h-4 w-4 text-gray-400 opacity-0 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" class="group px-6 py-3 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</span>
                                        <svg class="h-4 w-4 text-gray-400 opacity-0 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($inscripciones as $inscripcion)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 flex items-center justify-center rounded-full bg-blue-100">
                                                <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    @if(!$fueraDeRango)
                                                        <a href="{{ route('evaluar.show', $inscripcion->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                                            {{ $inscripcion->grupo->profesor->user->name }}
                                                        </a>
                                                    @else
                                                        {{ $inscripcion->grupo->profesor->user->name }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $inscripcion->grupo->asignatura->nombre }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm text-gray-900 font-medium">{{ $inscripcion->grupo->nombre }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm text-gray-900">{{ $inscripcion->grupo->seccion ?: '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($inscripcion->estado == 1)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Completado
                                            </span>
                                        @elseif($inscripcion->updated_at != null && $inscripcion->estado == 0)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <svg class="mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                En Proceso
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <svg class="mr-1.5 h-2 w-2 text-gray-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Sin Iniciar
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if(!$fueraDeRango)
                                            @if($inscripcion->estado == 1)
                                                <span class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-gray-50">
                                                    <svg class="mr-1.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                    Completada
                                                </span>
                                            @else
                                                <a href="{{ route('evaluar.show', $inscripcion->id) }}" 
                                                   class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    <svg class="mr-1.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                    </svg>
                                                    Evaluar
                                                </a>
                                            @endif
                                        @else
                                            <span class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-gray-50">
                                                <svg class="mr-1.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                </svg>
                                                Cerrada
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($fueraDeRango)
                <div class="mt-4 p-4 bg-yellow-50 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.667-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">
                                Periodo de evaluación cerrado
                            </h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>
                                    El periodo de evaluación está cerrado ({{ $fechaInicio->format('d/m/Y') }} - {{ $fechaCierre->format('d/m/Y') }}).
                                    Sin embargo, aún puedes descargar tu comprobante si completaste todas tus evaluaciones.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
        <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-xl sm:rounded-lg">
            <!-- Encabezado de la sección -->
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Comprobante de Evaluación CAD</h2>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875Z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-gray-500">Documento oficial</span>
                    </div>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="px-6 py-8">
                <div class="max-w-3xl mx-auto">
                    <!-- Mensaje informativo -->
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    Estimado alumno(a), una vez que hayas evaluado a todos tus profesores, podrás descargar tu comprobante oficial del CAD. Este documento incluye un código QR para su validación.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Estado de las evaluaciones -->
                    <div class="bg-white rounded-lg border border-gray-200 p-4 mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-gray-700">Estado de tus evaluaciones</h3>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $completados == $totalGrupos ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $completados }}/{{ $totalGrupos }} completadas
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 rounded-full {{ $completados == $totalGrupos ? 'bg-green-500' : 'bg-yellow-500' }}" 
                                 style="width: {{ ($completados / $totalGrupos) * 100 }}%"></div>
                        </div>
                    </div>

                    <!-- Botón de descarga -->
                    <div class="flex justify-center">
                        <a href="{{ route('dashboard.reporte')}}" 
                           class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white transition-all duration-200 ease-in-out transform bg-gradient-to-r from-green-600 to-green-700 rounded-lg hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-lg hover:shadow-xl">
                            <span class="absolute right-0 -mt-12 h-32 w-8 translate-x-12 rotate-12 transform bg-white opacity-10 transition-all duration-1000 ease-out group-hover:-translate-x-40"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Descargar comprobante del CAD
                        </a>
                    </div>

                    <!-- Información adicional -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-500">
                            El comprobante incluye un código QR único para su validación oficial
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        @if($fueraDeRango)
        <div id="modal-advertencia" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" x-data="{ show: true }" x-show="show">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                        <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L2.34 16.126c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mt-2">¡Advertencia!</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">
                            El período de evaluación en el CAD está cerrado. Las fechas de evaluación son del {{ $fechaInicio->format('d/m/Y') }} al {{ $fechaCierre->format('d/m/Y') }}.
                        </p>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button @click="show = false" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Entendido
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
