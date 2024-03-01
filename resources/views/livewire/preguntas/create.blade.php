<x-modal>
    <form wire:submit="store()" >
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                <div class="mb-4">
                    <x-label for="exampleFormControlInput1">Pregunta</x-label>
                    <x-textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput1" placeholder="Titulo de la pregunta" wire:model="titulo" >{{$titulo}}</x-textarea>
                    @error('titulo') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div>   <x-label for="exampleFormControlInput1">Agregar respuestas</x-label>
                    <button type="button" class="btn btn-sm btn-primary" id="agregar-respuesta-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9" />
                        </svg>
                    </button>
                </div>
                <div wire:ignore> {{-- Importante ignorar este div para evitar conflictos --}}
                    @foreach ($respuestas as $index => $respuesta)
                        <div class="form-group">
                            <label for="respuesta-{{ $index }}">Respuesta {{ $index + 1 }}:</label>
                            <input type="text" wire:model="respuestas.{{ $index }}" class="form-control" required>
                            <button type="button" wire:click="eliminarRespuesta({{ $index }})" class="btn btn-danger">Eliminar</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" wire:click="agregarRespuesta" class="btn btn-primary">Agregar Respuesta</button>
                <div class="mb-4">
                    <x-label for="exampleFormControlInput2">Rubro</x-label>
                    <select wire:model="rubro_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                        border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        id="exampleFormControlInput2">
                        <option value="" disabled>Seleccione un rubro</option>
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
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
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
