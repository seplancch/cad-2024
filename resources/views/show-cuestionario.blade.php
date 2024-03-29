<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cuestionarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                    <div class="mt-8 text-2xl">
                                        {{ $pregunta->titulo }}
                                    </div>
                                    <div class="mt-6 text-gray-500">
                                        <select name="" id=""
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                                            border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option value="">Seleccione una respuesta</option>
                                            @foreach ($pregunta->respuestas as $respuesta)
                                                <option>{{ $respuesta->respuesta }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
