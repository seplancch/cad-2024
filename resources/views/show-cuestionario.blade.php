<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cuestionarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @foreach ($preguntas as $item)
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="mt-8 text-2xl">
                            {{ $item->pregunta }}
                        </div>
                        <div class="mt-6 text-gray-500">
                            <ul>
                                @foreach ($item->respuestas as $respuesta)
                                    <li>{{ $respuesta->respuesta }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
