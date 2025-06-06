<div class="py-10">
    <div class="container mx-auto px-4">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-2xl font-bold text-blue-800 mb-6">Promedio de respuestas por grupo, rubro y pregunta</h3>
            <div class="space-y-10">
                @php
                    $grupoSel = $grupos->first();
                @endphp
                @if($grupoSel)
                    <div>
                        <h4 class="text-xl font-semibold text-green-700 mb-4">
                            Grupo: {{ $grupoSel->nombre }} - Sección: {{ $grupoSel->seccion }}
                        </h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full border text-sm">
                                <thead>
                                    <tr class="bg-blue-100">
                                        <th class="border px-4 py-2">Rubro</th>
                                        <th class="border px-4 py-2">Pregunta</th>
                                        <th class="border px-4 py-2">Promedio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($rubros as $rubro)
                                    @php $preguntasCount = $rubro->preguntas->count(); @endphp
                                    @foreach($rubro->preguntas as $preguntaIndex => $pregunta)
                                        <tr>
                                            @if($preguntaIndex === 0)
                                                <td class="border px-4 py-2 align-top" rowspan="{{ $preguntasCount }}">{{ $rubro->titulo }}</td>
                                            @endif
                                            <td class="border px-4 py-2">{{ $pregunta->titulo }}</td>
                                            <td class="border px-4 py-2 text-center">
                                                @php
                                                    $prom = $promedios[$grupoSel->id][$rubro->id][$pregunta->id] ?? null;
                                                @endphp
                                                @if($prom !== null)
                                                    {{ round($prom, 1) }}
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-green-100 font-bold">
                                        <td class="border px-4 py-2 text-right" colspan="2">Promedio general</td>
                                        <td class="border px-4 py-2 text-center">
                                            @php
                                                $suma = 0;
                                                $cuenta = 0;
                                                foreach($rubros as $rubro) {
                                                    foreach($rubro->preguntas as $pregunta) {
                                                        $prom = $promedios[$grupoSel->id][$rubro->id][$pregunta->id] ?? null;
                                                        if($prom !== null) {
                                                            $suma += $prom;
                                                            $cuenta++;
                                                        }
                                                    }
                                                }
                                            @endphp
                                            @if($cuenta > 0)
                                                {{ number_format($suma / $cuenta, 2) }}
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <hr class="my-6 border-t-2 border-blue-200">
                        <div class="text-sm text-gray-700 mt-4">
                            <span class="font-semibold">Alumnos que respondieron:</span>
                            @php
                                $alumnosRespondieron = 0;
                                $alumnosIds = [];
                                foreach($rubros as $rubro) {
                                    foreach($rubro->preguntas as $pregunta) {
                                        foreach(App\Models\Resultado::whereHas('inscripcion', function($q) use ($grupoSel) {
                                            $q->where('grupo_id', $grupoSel->id);
                                        })->where('pregunta_id', $pregunta->id)->get() as $resultado) {
                                            $alumnosIds[] = optional($resultado->inscripcion)->alumno_id;
                                        }
                                    }
                                }
                                $alumnosRespondieron = count(array_unique(array_filter($alumnosIds)));
                            @endphp
                            <span class="ml-2">{{ $alumnosRespondieron }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
