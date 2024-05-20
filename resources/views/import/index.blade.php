<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Importar profesores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-4">
                @if (session('error'))
                <div class="alert flex flex-row items-center bg-green-200 p-5 rounded border-b-2 border-green-300">
                        <div class="alert-description text-sm text-green-600">
                            {{session('error')}}
                        </div>

                </div>
                @endif

                <form action="{{ route('importar') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6 pt-4">
                        <label class="mb-5 block text-xl font-semibold text-[#07074D]">

                          {{  __('Selecciona el archivo CSV para importar profesores')}}
                        </label>

                        <div class="mb-8">
                            <input type="file" name="csv_file" id="file" class="sr-only" />
                            <label
                              for="file"
                              class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center"
                            >
                              <div>
                                <span class="mb-2 block text-xl font-semibold text-[#07074D]">
                                  Drop files here
                                </span>
                                <span class="mb-2 block text-base font-medium text-[#6B7280]">
                                    Or
                                  </span>
                                  <span
                                    class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]"
                                  >
                                    Browse
                                  </span>
                        </div>
                            </label>
                        </div>
                    </div>



                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                        Importar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
