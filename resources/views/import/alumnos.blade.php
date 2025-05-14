<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Importar Alumnos') }}
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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Encabezado -->
                <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Importar Alumnos</h2>
                            <p class="mt-1 text-sm text-gray-600">Periodo: {{ $periodoActual }}</p>
                        </div>
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Contenido -->
                <div class="p-6">
                    <!-- Mensajes de alerta -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Se encontraron los siguientes errores:</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
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
                        <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Formulario de importación -->
                    <div class="bg-white rounded-lg border border-gray-200 p-6">
                        <form id="upload-form" action="{{ route('importaAlumnos') }}" method="post" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            
                            <!-- Información del formato -->
                            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-blue-800">Formato Requerido</h3>
                                        <div class="mt-2 text-sm text-blue-700">
                                            <p>El archivo debe cumplir con las siguientes especificaciones:</p>
                                            <ul class="list-disc pl-5 mt-1 space-y-1">
                                                <li>Formato: Archivo CSV (.csv)</li>
                                                <li>Codificación: UTF-8</li>
                                                <li>Delimitador: Coma (,)</li>
                                                <li>Columnas requeridas: número_cuenta, nombre, plantel_id, semestre</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Área de carga de archivo -->
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Seleccione el archivo CSV
                                </label>
                                <div class="mt-1">
                                    <!-- Botón principal de carga -->
                                    <div class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors duration-200">
                                        <input type="file" 
                                               id="file-upload" 
                                               name="archivo_csv" 
                                               accept=".csv"
                                               class="hidden"
                                               onchange="document.getElementById('selected-file').textContent = this.files[0]?.name || 'Ningún archivo seleccionado'">
                                        
                                        <button type="button" 
                                                onclick="document.getElementById('file-upload').click()"
                                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                            </svg>
                                            Seleccionar archivo CSV
                                        </button>
                                        
                                        <p class="mt-2 text-sm text-gray-500">
                                            o arrastre y suelte el archivo aquí
                                        </p>
                                        
                                        <!-- Información del archivo seleccionado -->
                                        <div id="selected-file" class="mt-4 text-sm text-blue-600 font-medium">
                                            Ningún archivo seleccionado
                                        </div>
                                    </div>
                                    
                                    <!-- Mensaje de ayuda -->
                                    <p class="mt-2 text-xs text-gray-500">
                                        Tamaño máximo: 10MB. Formato: CSV con codificación UTF-8
                                    </p>
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition">
                                    Cancelar
                                </a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition">
                                    <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    Importar Alumnos
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.querySelector('.border-dashed');
    const fileInput = document.getElementById('file-upload');
    const selectedFileDisplay = document.getElementById('selected-file');

    if (!dropZone || !fileInput || !selectedFileDisplay) {
        console.error('Elementos necesarios no encontrados');
        return;
    }

    // Función para validar y mostrar el archivo
    function handleFile(file) {
        if (!file) return;

        if (file.type === 'text/csv' || file.name.toLowerCase().endsWith('.csv')) {
            selectedFileDisplay.textContent = file.name;
            selectedFileDisplay.className = 'mt-4 text-sm text-blue-600 font-medium';
            dropZone.classList.add('border-blue-400', 'bg-blue-50');
        } else {
            alert('Por favor, seleccione un archivo CSV válido.');
            fileInput.value = '';
            selectedFileDisplay.textContent = 'Ningún archivo seleccionado';
            selectedFileDisplay.className = 'mt-4 text-sm text-gray-500';
            dropZone.classList.remove('border-blue-400', 'bg-blue-50');
        }
    }

    // Evento change del input file
    fileInput.addEventListener('change', function(e) {
        handleFile(this.files[0]);
    });

    // Eventos de drag & drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, function(e) {
            e.preventDefault();
            e.stopPropagation();
        });
    });

    dropZone.addEventListener('dragenter', function() {
        this.classList.add('border-blue-400', 'bg-blue-50');
    });

    dropZone.addEventListener('dragleave', function() {
        if (!fileInput.files.length) {
            this.classList.remove('border-blue-400', 'bg-blue-50');
        }
    });

    dropZone.addEventListener('drop', function(e) {
        this.classList.remove('border-blue-400', 'bg-blue-50');
        const file = e.dataTransfer.files[0];
        if (file) {
            fileInput.files = e.dataTransfer.files;
            handleFile(file);
        }
    });
});
</script>
@endpush


