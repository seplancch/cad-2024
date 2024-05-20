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
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                <div class="flex justify-between mb-6">
                    <div>
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-semibold">Cuestionario de Actividad Docente</div>
                        </div>
                        <div class="text-sm font-medium text-gray-600"><strong>Nombre:</strong> {{$usuario->name}}</div>
                        <div class="text-sm font-medium text-gray-600"><strong>Cuenta:</strong> {{$usuario->alumno->numero_cuenta}}</div>
                        <div class="text-sm font-medium text-gray-600"><strong>Semestre:</strong> {{$semestre}}</div>
                        <div class="text-sm font-medium text-gray-600"><strong>Plantel:</strong> {{$usuario->alumno->plantel[0]->nombre}}</div>
                    </div>
                </div>
                <div>
                    <!-- <div class="flex items-center text-sm font-medium text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2">Completado</span>
                    </div> -->
                    <div class="flex items-center text-sm font-medium text-yellow-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2">En proceso</span>
                    </div>
                </div>
            </div>
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
                <!-- <div class="flex items-center text-sm font-medium text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2">Completado</span>
                </div> -->

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
        </div>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
            <div class="w-full mb-2 select-none border-l-4 border-blue-400 bg-blue-100 p-4 font-medium hover:border-blue-500">¡Evalúa al profesor y ayúdanos a mejorar la calidad de la enseñanza!<br/>
                Haz clic en el nombre del profesor que aparece en la lista para realizar tu evaluación.</div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-4">

                <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
                    <caption>Profesores a evaluar: {{ count($inscripciones) }}</caption>
                    <thead class="text-xs text-gray-800  bg-gray-200 dark:bg-gray-700 dark:text-gray-500">
                        <tr class="">
                            <th class="px-4 py-3 text-left rtl:text-right tracking-wider">Profesor</th>
                            <th class="px-4 py-3 text-left rtl:text-right tracking-wider">Asignatura</th>
                            <th class="px-4 py-3 text-left rtl:text-right tracking-wider">Grupo</th>
                            <th class="px-4 py-3 text-left rtl:text-right tracking-wider">Sección</th>
                            <th class="px-4 py-3 text-left rtl:text-right tracking-wider">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($inscripciones as $inscripcion)
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <a href="{{ route('cuestionario', $inscripcion->id) }}"><img class="h-10 w-10 rounded-full shadow shadow-gray-400" src="https://cad.cch.unam.mx/foto_profesor.php?ntrabajador={{$inscripcion->grupo->profesor->numero_trabajador}}&key=KAEflb63ZA4B5me2Jf4bevsJnE3SSALe" alt=""></a>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="{{ route('cuestionario', $inscripcion->id) }}">{{ $inscripcion->grupo->profesor->user->name }}</a>
                                            </div>
                                            <!--<div class="text-sm text-gray-500">
                                                jane.cooper@example.com
                                            </div>-->
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300"><a href="{{ route('cuestionario', $inscripcion->id) }}">{{ $inscripcion->grupo->asignatura->nombre }}</a></td>
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $inscripcion->grupo->nombre }}</td>
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $inscripcion->grupo->seccion }}</td>
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">
                                    @if( $inscripcion->estado )
                                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Completado</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Pendiente</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-4 flex flex-col items-center justify-center">

            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p>Estimado alumno ó alumna, una vez que hayas evaluado a todos tus profesores, podrás descargar tu comprobante del CAD.</p>
            </div>


            <a href="{{ route('dashboard.report')}}" type="button" class="px-6 py-3.5 mt-8 mb-4 text-base font-medium text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875Zm5.845 17.03a.75.75 0 0 0 1.06 0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72V12a.75.75 0 0 0-1.5 0v4.19l-1.72-1.72a.75.75 0 0 0-1.06 1.06l3 3Z" clip-rule="evenodd" />
                    <path d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
                </svg>
                Descargar comprobante del CAD
            </a>
        </div>
    </div>
</x-app-layout>
