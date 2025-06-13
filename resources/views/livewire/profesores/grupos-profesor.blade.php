<div class="p-6">
    <h2 class="text-3xl font-extrabold mb-8 text-blue-800">Mis Grupos Asignados</h2>
    <h3 class="text-lg font-medium mb-6 text-gray-600">Profesor: {{ Auth::user()->name }}</h3>
    <div class="mb-6">
        <a href="{{ route('profesor.comprobante.pdf') }}" class="inline-flex items-center text-sm text-white bg-green-700 hover:bg-green-800 px-5 py-3 rounded-lg shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11v6m0 0l-2-2m2 2l2-2" />
            </svg>
            Descargar Comprobante
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($grupos as $grupo)
            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                <div id="grupo-{{ $grupo->id }}" class="bg-gray-50 p-4 rounded-md relative">
                    <div class="absolute top-2 right-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-700"><strong>Asignatura:</strong> {{ $grupo->asignatura->nombre ?? '-' }}</p>
                    <p class="text-sm text-gray-700"><strong>Plantel:</strong> {{ $grupo->plantel->nombre ?? '-' }}</p>
                    <p class="text-sm text-gray-700"><strong>Periodo:</strong> {{ $grupo->periodo->clave ?? '-' }}</p>
                    <p class="text-sm text-gray-700"><strong>Grupo:</strong> {{ $grupo->nombre }}</p>
                    <p class="text-sm text-gray-700"><strong>Sección:</strong> {{ $grupo->seccion ?? '-' }}</p>
                </div>
                <div class="mt-4 bg-blue-50 p-4 rounded-md border-l-4 border-blue-500">
                    <p class="text-lg text-blue-900 font-extrabold"><strong>Promedio Grupo:</strong> {{ $grupo->promedio_general ?? '-' }}</p>
                </div>
                <div class="mt-4">
                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Promedios por Rubro:</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($grupo->promedios_por_rubro as $rubro)
                            <div class="bg-gray-100 p-3 rounded-md shadow-sm">
                                <p class="text-sm text-gray-800 font-medium">{{ $rubro->titulo }}</p>
                                <p class="text-sm text-blue-800 font-bold">{{ $rubro->promedio ?? '-' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <a href="{{ route('profesor.promedios', ['grupo' => $grupo->id]) }}" class="inline-block text-center text-sm text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg shadow-md font-semibold">
                        Detalles
                    </a>
                    <a href="{{ route('profesor.graficos', ['grupo' => $grupo->id]) }}" class="inline-block text-center text-sm text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg shadow-md font-semibold">
                        Gráficos
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 py-6">No tienes grupos asignados en este periodo.</p>
        @endforelse
    </div>
</div>
