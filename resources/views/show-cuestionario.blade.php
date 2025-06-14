<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cuestionarios') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
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
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    @endif

    <div class="flex items-center justify-center py-1">
         <!-- CARD -->
        <div class="max-w-[300px] p-8 rounded-xl text-gray-500 dark:text-gray-400 overflow-hidden group
        hover:shadow-2xl hover:shadow-sky-500/50 motion-safe:transition-all motion-safe:duration-700 hover:border hover:bg-sky-700">
            <figure class="flex items-center justify-center relative w-40 h-40 m-0 mx-auto rounded-full outline outline-offset-4 outline-sky-500
                before:content-[''] before:absolute before:block before:pointer-events-none before:rounded-full before:h-full before:w-full before:-z-[1]
                group-hover:before:scale-[2.5] motion-safe:before:transition-all
                motion-safe:transform-gpu motion-safe:before:duration-500 before:origin-center group-hover:outline-sky-400 overflow-hidden bg-white">
                <img class="rounded-full block max-w-full object-cover z-10 relative remove-bg"
                src="https://cad.cch.unam.mx/foto_profesor.php?ntrabajador={{$inscripcion->grupo->profesor->numero_trabajador}}&key=KAEflb63ZA4B5me2Jf4bevsJnE3SSALe"
                    alt="{{ $inscripcion->grupo->profesor->user->name }}" />
            </figure>
            <header class="motion-safe:translate-y-4 group-hover:translate-y-0 motion-safe:transition-transform motion-safe:transform-gpu motion-safe:duration-500">
            <h3 class="font-semibold text-2xl text-center text-sky-500 mt-1 group-hover:text-gray-50 dark:group-hover:text-gray-800 relative">{{ $inscripcion->grupo->profesor->user->name }}</h3>
            <p class="text-center group-hover:text-gray-50 dark:group-hover:text-gray-800 relative">{{$inscripcion->grupo->asignatura->nombre}} </p>
            </header>
        </div>
    </div>



    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('cuestionario.store', $id) }}" method="POST">
                @csrf
                <input type="hidden" name="inscripcion_id" value="{{$id}}">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    @foreach ($rubros as $item)
                        <div class="">
                            <h1 class="text-2xl font-bold text-gray-700 bg-blue-200 p-1 mt-4 ml-4 flex items-start">
                                <svg class="fill-current w-8 h-8 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                                </svg>
                                <span>{{ $item->titulo }}</span>
                            </h1>
                            @foreach ($preguntas as $pregunta)
                                @if($pregunta->rubro_id == $item->id)
                                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200 m-4">
                                        <div class="text-2xl">
                                            {{ $pregunta->id }}.- {{ $pregunta->titulo }}
                                        </div>
                                        <div class="mt-6 text-gray-500">
                                            <select id="" name="respuesta_{{ $pregunta->id }}" class="shadow appearance-none border rounded w-full  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @if($errors->has('respuesta_'.$pregunta->id)) border-red-500 @endif">
                                                <option value="">Seleccione una respuesta</option>
                                                @foreach ($pregunta->respuestas as $respuesta)
                                                <option value="{{$respuesta->id}}" {{ old('respuesta_' . $pregunta->id) == $respuesta->id ? 'selected' : '' }}>{{ $respuesta->respuesta }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach

                    <div class="authButtons basis-1/4 flex flex-col items-center justify-center">
                        <x-button type="submit" class="mt-8 mb-8">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>

                            <span>&nbsp;{{ __('Guardar evaluación') }}</span>
                        </x-button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>
