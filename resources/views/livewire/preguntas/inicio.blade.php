<div id='seccionPreguntas' class="py-4">
    @if (session()->has('message'))
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-4" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div class="ml-4">
                    <p class="text-sm">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md my-3"
            role="alert">
            <div class="flex">
                <div>
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        @if($cuestionario_id > 0)
            <a href="{{ route('cuestionarios.show', $cuestionario_id) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                Volver al Cuestionario
            </a>
        @endif

        @if ( $cuestionario_id > 0)
            <x-button wire:click="create()" class="ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="fill-current w-4 h-4 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Crear pregunta</span>
            </x-button>
        @endif
    </div>

    @if($isModalOpen)
        @include('livewire.preguntas.nueva')
    @endif

    @if($isDeleteModalOpen)
        <x-dialog-modal wire:model="isDeleteModalOpen">
            <x-slot name="title">
                Confirmar Eliminación
            </x-slot>

            <x-slot name="content">
                ¿Está seguro que desea eliminar la pregunta "{{ $preguntaToDelete->titulo }}"?
                @if($preguntaToDelete->estaEnUso())
                    <p class="mt-2 text-sm text-red-600">
                        Advertencia: Esta pregunta está siendo utilizada en evaluaciones y no puede ser eliminada.
                    </p>
                @endif
            </x-slot>

            <x-slot name="footer">
                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <x-danger-button wire:click="delete({{ $preguntaToDelete->id }})">
                            Eliminar
                        </x-danger-button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <x-secondary-button wire:click="cancelDelete()" type="button">
                            Cancelar
                        </x-secondary-button>
                    </span>
                </div>
            </x-slot>
        </x-dialog-modal>
    @endif

    @php
        $tienePreguntas = isset($preguntas) && $preguntas instanceof \Illuminate\Support\Collection && $preguntas->count() > 0;
        \Log::info('En la vista preguntas:', [
            'isset_preguntas' => isset($preguntas),
            'tipo_preguntas' => isset($preguntas) ? get_class($preguntas) : 'no definido',
            'count' => isset($preguntas) ? $preguntas->count() : 'no count',
            'tienePreguntas' => $tienePreguntas,
            'primer_pregunta' => isset($preguntas) && $preguntas->count() > 0 ? $preguntas->first()->toArray() : null
        ]);
    @endphp

    @if($tienePreguntas)
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <div class="min-w-full divide-y divide-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <caption class="sr-only">Listado de preguntas</caption>
            <thead class="bg-gray-50">
                <tr>
                            <th scope="col" class="w-16 px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pregunta</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rubro</th>
                            <th scope="col" class="w-24 px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($preguntas as $pregunta)
                    <tr>
                                <td class="w-16 px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $loop->iteration }}
                        </td>
                                <td class="px-3 py-4 text-sm text-gray-500">
                                    <div class="max-w-xl break-words">
                            {{ $pregunta->titulo }}
                                    </div>
                        </td>
                                <td class="px-3 py-4 text-sm text-gray-500">
                                    <div class="max-w-xl break-words">
                                        {{ $pregunta->rubro->titulo }}
                                    </div>
                        </td>
                                <td class="w-24 px-3 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button wire:key="p-{{ $pregunta->id }}" wire:click="edit({{ $pregunta->id }})"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button wire:click="confirmDelete({{ $pregunta->id }})"
                                    class="text-red-600 hover:text-red-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
</div>

@push('styles')
<style>
    /* Estilos personalizados para el paginador */
    .pagination {
        @apply flex items-center space-x-1;
    }
    .pagination > * {
        @apply inline-flex items-center justify-center min-w-[2rem] px-3 py-2 text-sm font-medium rounded-md;
    }
    .pagination > a {
        @apply text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 hover:text-gray-900;
    }
    .pagination > span {
        @apply text-white bg-indigo-600 border border-indigo-600;
    }
    .pagination > a[rel="prev"],
    .pagination > a[rel="next"] {
        @apply px-4;
    }
    .pagination > a[rel="prev"]:disabled,
    .pagination > a[rel="next"]:disabled {
        @apply opacity-50 cursor-not-allowed;
    }
</style>
@endpush
