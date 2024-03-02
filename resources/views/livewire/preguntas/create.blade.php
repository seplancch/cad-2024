<x-modal>
    <form wire:submit.prevent="store()" >
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
                    <div>
                        <button wire:click="agregarRespuesta" type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center mb-2" id="agregar-respuesta-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="fill-current w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span>Agregar</span>
                        </button>
                    </div>
                    @foreach ($respuestas as $key => $input)
                        <div wire:key="{{ $key }}" class="mb-2">
                            <x-input type="text" wire:model="respuestas.{{ $key }}" />
                            @if ($key > 0)
                                <button wire:click="eliminarRespuesta({{ $key }})" type="button" class="bg-red-300 hover:bg-red-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" id="remover-respuesta-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="fill-current w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    @endforeach
                    @error('respuestas.*') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>

                <div class="mb-4">
                    <x-label for="exampleFormControlInput2">Rubro</x-label>
                    <select wire:model="rubro_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                        border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        id="exampleFormControlInput2">
                        <option value="">Seleccione un rubro</option>
                        @foreach($rubros as $rubro)
                            <option value="{{ $rubro->id }}">{{ $rubro->titulo }}</option>
                        @endforeach
                    </select>
                    @error('rubro_id') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <x-button type="submit"
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 hover:bg-green-400 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Guardar
                </x-button>
            </span>
            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                <x-button wire:click="closeModalPopover()" type="button"
                    class="inline-flex justify-center w-full rounded-md border text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Cerrar
                </x-button>
            </span>
        </div>
    </form>

    @push('scripts')
        <script>
            document.querySelectorAll('.remover-respuesta').forEach(function(button) {
                button.addEventListener('click', function() {
                    button.parentNode.remove();
                });
            });

            document.querySelectorAll('.agregar-respuesta').forEach(function(button) {
                button.addEventListener('click', function() {
                    const preguntaId = button.getAttribute('data-pregunta-id');
                    const respuestaHtml = `<div class="flex items-center justify-between mb-3">
                                            <input type="text" class="form-control w-full mr-3">
                                            <button type="button" class="btn btn-sm btn-danger remover-respuesta">
                                        ;

        </script>
    @endpush
</x-modal>
