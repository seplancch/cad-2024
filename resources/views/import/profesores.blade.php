<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Importar profesores') }}
        </h2>
    </x-slot>

    @if ($errors->any())
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
        <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md my-3" role="alert">
            <div class="flex">
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (session('error'))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
        <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md my-3" role="alert">
            <div class="flex">
                <div>
                    {{ session('error') }}
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (session('success'))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
        <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-3" role="alert">
            <div class="flex">
                <div>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
    @endif


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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-6 py-4">

                <h2 class="font-semibold text-xl text-gray-600 leading-tight mb-4 text-center mb-2">Cargando profesores del periodo {{ $periodoActual }}</h2>
                <form id="upload-form" action="{{ route('importaProfesores') }}" method="post" enctype="multipart/form-data" class="w-full max-w-lg">
                    @csrf
                    <!-- file upload modal -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                Seleccione un archivo CSV
                            </label>
                            <input name="archivo_csv" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-100 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="file">
                            <p class="text-blue-500 text-xs italic">seleccione archivo en extencion .csv.</p>
                        </div>
                    </div>
                    <button type="submit" class="rounded-sm px-3 py-1 bg-blue-700 hover:bg-blue-500 text-white focus:shadow-outline focus:outline-none">Cargar Profesores</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
