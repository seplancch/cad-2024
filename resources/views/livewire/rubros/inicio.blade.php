<div class="py-12 px-6">
    @if (session()->has('message'))
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
            role="alert">
            <div class="flex">
                <div>
                    <p class="text-sm">{{ session('message') }}</p>
                </div>
            </div>
        </div>

    @endif
    <x-button wire:click="create()" class="my-4">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="fill-current w-4 h-4 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        <span>Crear Rubro</span>
    </x-button>

    @if($isModalOpen)
        @include('livewire.rubros.nueva')

    @endif
    <table class="table-auto w-full divide-gray-200">
        <caption>Listado de rubros</caption>
        <thead class="text-xs text-gray-800  bg-gray-200 dark:bg-gray-700 dark:text-gray-500">
            <tr>
                <th class="py-3 px-4 text-left rtl:text-right">No.</th>
                <th class="py-3 px-4 text-left rtl:text-right">Titulo</th>
                <th class="py-3 px-4 text-left rtl:text-right">Descripción</th>
                <th class="py-3 px-4 text-left rtl:text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($rubros as $index => $rubro)
                <tr>
                    <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $rubro->id }}</td>
                    <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $rubro->titulo }}</td>
                    <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $rubro->descripcion}}</td>
                    <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">
                        <button wire:click="edit({{ $rubro->id }})"
                            class="relative align-middle select-none font-sans font-medium text-center uppercase
                                transition-all disabled:shadow-none disabled:pointer-events-none
                                disabled:opacity-50 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs
                                text-blue-gray-500 w-10 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30"
                        type="button">
                            <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="h-4 w-4">
                                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"></path>
                                </svg>
                            </span>
                        </button>
                        <button wire:click="delete({{ $rubro->id }})"
                            class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30" type="button">
                            <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
