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
                        <x-label for="exampleFormControlInput1">Titulo</x-label>
                        <x-input type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="exampleFormControlInput1" placeholder="Titulo de la cuestionario" wire:model="titulo" />
                        @error('titulo') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-4">
                        <x-label for="exampleFormControlInput2">Descripción</x-label>
                        <x-textarea
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="exampleFormControlInput2" wire:model="descripcion"
                            placeholder="Descripción de la cuestionario"></x-textarea>
                        @error('descripcion') <span class="text-red-500">{{ $message }}</span>@enderror
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
