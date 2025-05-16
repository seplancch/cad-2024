<form wire:submit.prevent="store()">
    @csrf
    <x-dialog-modal>
        <x-slot name="title">
            Crear Pregunta
        </x-slot>
        <x-slot name="content">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="">
                    <div class="mb-4">
                        <x-label for="exampleFormControlInput1">Pregunta</x-label>
                        <x-textarea
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="exampleFormControlInput1" placeholder="Titulo de la pregunta" wire:model="titulo" >{{$titulo}}</x-textarea>
                        @error('titulo') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-4">
                        <x-label for="exampleFormControlInput1">Indiqué las respuestas de las preguntas</x-label>
                        @error('respuestas')
                            <div class="mt-2 bg-red-50 border-l-4 border-red-400 p-4 mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-red-700">{{ $message }}</p>
                                    </div>
                                </div>
                            </div>
                        @enderror
                        <div>
                            <button wire:click="agregarRespuesta" type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center mb-2" id="agregar-respuesta-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="fill-current w-4 h-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>Agregar</span>
                            </button>
                        </div>
                        @foreach ($respuestas as $key => $input)
                            <div wire:key="{{ $key }}" class="mb-4 p-4 border border-gray-200 rounded-lg {{ isset($input['en_uso']) && $input['en_uso'] ? 'bg-gray-50' : '' }}">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="col-span-2">
                                        <x-label for="respuesta_{{ $key }}">Respuesta {{ isset($input['en_uso']) && $input['en_uso'] ? '(En uso)' : '' }}</x-label>
                                        <div class="mt-1">
                                            <input 
                                                type="text" 
                                                id="respuesta_{{ $key }}" 
                                                wire:model.live="respuestas.{{ $key }}.respuesta" 
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm {{ isset($input['en_uso']) && $input['en_uso'] ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                                {{ isset($input['en_uso']) && $input['en_uso'] ? 'disabled' : '' }}
                                                placeholder="Ingrese el texto de la respuesta"
                                            />
                                        </div>
                                        @error("respuestas.{$key}.respuesta") 
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                        @if(isset($input['en_uso']) && $input['en_uso'])
                                            <p class="text-sm text-gray-500 mt-1">Esta respuesta está siendo utilizada en evaluaciones y no puede ser modificada.</p>
                                        @endif
                                    </div>
                                    <div>
                                        <x-label for="orden_{{ $key }}">Orden</x-label>
                                        <x-input 
                                            type="number" 
                                            id="orden_{{ $key }}" 
                                            wire:model="respuestas.{{ $key }}.orden" 
                                            class="w-full" 
                                            min="1" 
                                        />
                                        @error("respuestas.{$key}.orden") <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                                    </div>
                                    <div>
                                        <x-label for="puntos_{{ $key }}">Puntos</x-label>
                                        <x-input 
                                            type="number" 
                                            id="puntos_{{ $key }}" 
                                            wire:model="respuestas.{{ $key }}.puntos" 
                                            class="w-full" 
                                            min="0" 
                                            step="0.5" 
                                        />
                                        @error("respuestas.{$key}.puntos") <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                @if ($key > 0 && (!isset($input['en_uso']) || !$input['en_uso']))
                                    <div class="mt-2">
                                        <button wire:click="eliminarRespuesta({{ $key }})" type="button" class="bg-red-300 hover:bg-red-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="fill-current w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                            </svg>
                                            <span class="ml-2">Eliminar respuesta</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-4">
                        <x-label for="exampleFormControlInput2">Rubro</x-label>
                        <x-select-list wire:model="rubro_id"  id="exampleFormControlInput2">
                            <option value="">Seleccione un rubro</option>
                            @foreach($rubros as $rubro)
                                <option value="{{ $rubro->id }}">{{ $rubro->titulo }}</option>
                            @endforeach
                        </x-select-list>
                        @error('rubro_id') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <x-button type="submit">
                        Guardar
                    </x-button>
                </span>
                <span class=" mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    <x-secondary-button wire:click="closeModalPopover()" type="button">
                        Cerrar
                    </x-secondary-button>
                </span>
            </div>
        </x-slot>
    </x-dialog-modal>
</form>
