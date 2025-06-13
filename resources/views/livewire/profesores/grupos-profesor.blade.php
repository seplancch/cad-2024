<div class="p-6">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Mis Grupos Asignados</h2>
    <h3 class="text-lg font-semibold mb-4 text-gray-700">Profesor: {{ Auth::user()->name }}</h3>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('id')">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('nombre')">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('seccion')">Sección</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asignatura</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plantel</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periodo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Promedio General</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detalles</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($grupos as $grupo)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $grupo->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $grupo->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $grupo->seccion }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $grupo->asignatura->nombre ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $grupo->plantel->nombre ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $grupo->periodo->clave ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-800 font-bold">
                            {{ $grupo->promedio_general ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <a href="{{ route('profesor.promedios', ['grupo' => $grupo->id]) }}" class="inline-flex items-center text-sm text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6" />
                                </svg>
                                Detalles
                            </a>
                            <a href="{{ route('profesor.graficos', ['grupo' => $grupo->id]) }}" class="inline-flex items-center text-sm text-white bg-teal-600 hover:bg-teal-700 px-4 py-2 rounded shadow ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3zm0 0v4m0-4H8m4 0h4" />
                                </svg>
                                Gráficos
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">No tienes grupos asignados en este periodo.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
