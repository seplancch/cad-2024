<x-modal>
    <form>
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                <div class="mb-4">
                    <x-label for="exampleFormControlInput1">Pregunta</x-label>
                    <x-textarea type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput1" placeholder="Titulo de la pregunta" wire:model="titulo" ></x-textarea>
                    @error('titulo') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <x-label for="exampleFormControlInput2">Respuesta 1</x-label>
                    <x-textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput2" wire:model="opcion_1"
                        placeholder="Descripción de la pregunta"></x-textarea>
                    @error('opcion_3') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <x-label for="exampleFormControlInput2">Respuesta 2</x-label>
                    <x-textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput2" wire:model="opcion_2"
                        placeholder="Versión de la pregunta"></x-textarea>
                    @error('opcion_2') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <x-label for="exampleFormControlInput2">Respuesta 3</x-label>
                    <x-textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput2" wire:model="opcion_3"
                        placeholder="Versión de la pregunta"></x-textarea>
                    @error('opcion_3') <span class="text-red-500">{{ $message }}</span>@enderror
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
                <button wire:click.prevent="store()" type="button"
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Guardar
                </button>
            </span>
            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                <button wire:click="closeModalPopover()" type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Cerrar
                </button>
            </span>
        </div>
    </form>
</x-modal>
