<div class="overflow-x-auto bg-white rounded shadow p-6 mb-8">
    <h3 class="text-xl font-bold mb-4 text-blue-800">Promedio de respuestas por grupo, rubro y pregunta</h3>
    <div class="space-y-10">
        @php
            $grupoSel = $grupos->first();
        @endphp
        @if($grupoSel)
            <div>
                <h4 class="text-lg font-semibold text-green-700 mb-2">
                    Grupo: {{ $grupoSel->nombre }} - Sección: {{ $grupoSel->seccion }}
                </h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full border text-xs md:text-sm">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="border px-2 py-1">Rubro</th>
                                <th class="border px-2 py-1">Pregunta</th>
                                <th class="border px-2 py-1">Promedio</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($rubros as $rubro)
                            @php $preguntasCount = $rubro->preguntas->count(); @endphp
                            @foreach($rubro->preguntas as $preguntaIndex => $pregunta)
                                <tr>
                                    @if($preguntaIndex === 0)
                                        <td class="border px-2 py-1 align-top" rowspan="{{ $preguntasCount }}">{{ $rubro->titulo }}</td>
                                    @endif
                                    <td class="border px-2 py-1">{{ $pregunta->titulo }}</td>
                                    <td class="border px-2 py-1 text-center">
                                        @php
                                            $prom = $promedios[$grupoSel->id][$rubro->id][$pregunta->id] ?? null;
                                        @endphp
                                        @if($prom !== null)
                                            {{ number_format($prom, 2) }}
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
                                <td class="border px-2 py-1 text-right" colspan="2">Promedio general</td>
                                <td class="border px-2 py-1 text-center">
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
                <div class="text-sm md:text-base text-gray-700 mt-2">
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
