<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Preguntas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(!$cuestionario_id)
                    @livewire('cuestionario-selector')
                @else
                    @if(isset($cuestionario) && $cuestionario)
                        <div class="mb-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ $cuestionario->titulo }}</h3>
                            <p class="text-sm text-gray-500">{{ $cuestionario->descripcion }}</p>
                            <p class="text-sm text-gray-500 mt-2">
                                Total de preguntas: {{ $cuestionario->preguntas->count() }}
                            </p>
                        </div>

                        @if($cuestionario->preguntas->count() > 0)
                            <div class="mt-4 space-y-4">
                                @foreach($cuestionario->preguntas as $index => $pregunta)
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $index + 1 }}. {{ $pregunta->pregunta }}
                                        </p>
                                        @if($pregunta->rubro)
                                            <p class="text-xs text-gray-500 mt-1">
                                                Rubro: {{ $pregunta->rubro->nombre }}
                                            </p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="mt-4 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            No hay preguntas asociadas a este cuestionario.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <p class="text-red-600 mb-4">El cuestionario seleccionado no existe.</p>
                            <a href="{{ route('cuestionarios') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                                </svg>
                                Ir a Cuestionarios
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
