<div class="p-6">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Mis Grupos Asignados</h2>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $grupo->periodo->nombre ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-800 font-bold">
                            @php
                                $suma = 0;
                                $cuenta = 0;
                                $rubros = App\Models\Rubro::with('preguntas')->get();
                                foreach($rubros as $rubro) {
                                    foreach($rubro->preguntas as $pregunta) {
                                        $query = App\Models\Resultado::whereHas('inscripcion', function($q) use ($grupo) {
                                            $q->where('grupo_id', $grupo->id);
                                        })
                                        ->where('resultados.pregunta_id', $pregunta->id)
                                        ->join('respuestas', 'resultados.respuesta_id', '=', 'respuestas.id');
                                        $prom = $query->avg('respuestas.puntos');
                                        if($prom !== null) {
                                            $suma += $prom;
                                            $cuenta++;
                                        }
                                    }
                                }
                            @endphp
                            {{ $cuenta > 0 ? number_format($suma / $cuenta, 2) : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <a href="{{ route('profesor.promedios', ['grupo' => $grupo->id]) }}" class="text-blue-600 hover:text-blue-800">Ver Detalles</a>
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
