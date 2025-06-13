<div class="p-6">
    <h2 class="text-3xl font-extrabold mb-8 text-blue-800">Mis Grupos Asignados</h2>
    <h3 class="text-lg font-medium mb-6 text-gray-600">Profesor: {{ Auth::user()->name }}</h3>
    <div class="mb-6">
        <a href="{{ route('profesor.comprobante.pdf') }}" class="inline-flex items-center text-sm text-white bg-green-700 hover:bg-green-800 px-5 py-3 rounded-lg shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 2v6h6" />
            </svg>
            Descargar Comprobante PDF
        </a>
    </div>
    <div class="bg-gray-50 shadow-lg rounded-lg divide-y divide-gray-300">
        @forelse($grupos as $grupo)
            <div class="p-6">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">{{ $grupo->nombre }} <span class="text-sm text-gray-500">(Sección: {{ $grupo->seccion }})</span></h3>
                <div class="grid grid-cols-2 gap-6">
                    <p class="text-base text-gray-700"><strong>Asignatura:</strong> {{ $grupo->asignatura->nombre ?? '-' }}</p>
                    <p class="text-base text-gray-700"><strong>Plantel:</strong> {{ $grupo->plantel->nombre ?? '-' }}</p>
                    <p class="text-base text-gray-700"><strong>Periodo:</strong> {{ $grupo->periodo->clave ?? '-' }}</p>
                    <p class="text-base text-blue-900 font-bold"><strong>Promedio General:</strong> {{ $grupo->promedio_general ?? '-' }}</p>
                </div>
                <div class="mt-6">
                    <h4 class="text-lg font-semibold text-gray-700 mb-3">Promedios por Rubro:</h4>
                    <ul class="list-disc list-inside space-y-2">
                        @foreach ($grupo->promedios_por_rubro as $rubro)
                            @if ($rubro->titulo === 'Autoevaluación del estudiante.')
                                <li class="text-base text-gray-700 border-b border-gray-400 pb-2 mb-2">
                                    <strong>{{ $rubro->titulo }}:</strong> {{ $rubro->promedio ?? '-' }}
                                </li>
                            @else
                                <li class="text-base text-gray-700">
                                    <strong>{{ $rubro->titulo }}:</strong> {{ $rubro->promedio ?? '-' }}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="mt-6 flex flex-wrap gap-4">
                    <a href="{{ route('profesor.promedios', ['grupo' => $grupo->id]) }}" class="inline-flex items-center text-sm text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-3 rounded-lg shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6" />
                        </svg>
                        Ver Detalles
                    </a>
                    <a href="{{ route('profesor.graficos', ['grupo' => $grupo->id]) }}" class="inline-flex items-center text-sm text-white bg-teal-600 hover:bg-teal-700 px-6 py-3 rounded-lg shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3zm0 0v4m0-4H8m4 0h4" />
                        </svg>
                        Ver Gráficos
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 py-6">No tienes grupos asignados en este periodo.</p>
        @endforelse
    </div>
</div>
