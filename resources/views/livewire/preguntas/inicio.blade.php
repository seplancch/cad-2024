<div id='seccionPreguntas' class="py-4">
    @if (session()->has('message'))
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div class="ml-4">
                    <p class="text-sm">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif


    @if ( $cuestionario_id > 0)
        <x-button wire:click="create()" class="my-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="fill-current w-4 h-4 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>Crear pregunta</span>
        </x-button>

        @if($isModalOpen)
            @include('livewire.preguntas.nueva')

        @endif
        <table class="table-auto w-full divide-gray-200">
            <caption>Listado de preguntas </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="bg-gray-100">
                    <th class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500">No.</th>
                    <th class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500">Pregunta</th>
                    <th class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500">rubro</th>
                    <th class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($preguntas as $index => $pregunta)
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $pregunta->id }}</td>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $pregunta->titulo }}</td>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $pregunta->rubro->titulo}}</td>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                            <button wire:key="p-{{ $pregunta->id }}" wire:click="edit({{ $pregunta->id }})"
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
                            <button wire:click="delete({{ $pregunta->id }})"
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
        <div class="py-4 px-3">
            <div class="flex">
                <div class="flex space-x-4 items-center mb-3 px-4">
                    <label for="">Por Pagina</label>
                    <x-select-list name="" id="" class="">
                        <option value="" wire:click="numeroPaginas(10)"">10</option>
                        <option value="" wire:click="numeroPaginas(20)"">20</option>
                        <option value="" wire:click="numeroPaginas(50)"">50</option>
                        <option value="" wire:click="numeroPaginas(100)"">100</option>
                    </x-select-list>
                </div>
                {{ $preguntas->links() }}
            </div>
        </div>
    @endif
</div>
