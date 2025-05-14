<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación CAD - {{ $periodo }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-2xl w-full">
            <div class="text-center mb-8">
                <div class="flex justify-center items-center space-x-8 mb-4">
                    <img src="{{ asset('img/unam.svg') }}" alt="UNAM" class="h-16">
                    <img src="{{ asset('img/cch.svg') }}" alt="CCH" class="h-16">
                    <img src="{{ asset('img/seplan_logo.png') }}" alt="CAD" class="h-16">
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mt-4">Validación de Comprobante CAD</h1>
                <p class="text-gray-600">Periodo: {{ $periodo }}</p>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Información del Alumno</h2>
                        <p class="text-gray-600">Nombre: {{ $alumno->user->name }}</p>
                        <p class="text-gray-600">No. Cuenta: {{ $alumno->numero_cuenta }}</p>
                        <p class="text-gray-600">Plantel: {{ $alumno->plantel[0]->nombre }}</p>
                    </div>
                    <div class="text-right">
                        <div class="inline-flex items-center px-4 py-2 rounded-full {{ $valido ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                @if($valido)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                @endif
                            </svg>
                            <span class="font-semibold">{{ $valido ? 'Válido' : 'Inválido' }}</span>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Estado de Evaluaciones</h3>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Total de Grupos</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalGrupos }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Evaluaciones Completadas</p>
                            <p class="text-2xl font-bold {{ $completados == $totalGrupos ? 'text-green-600' : 'text-yellow-600' }}">{{ $completados }}</p>
                        </div>
                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                        <div class="h-2.5 rounded-full {{ $completados == $totalGrupos ? 'bg-green-600' : 'bg-yellow-500' }}" 
                             style="width: {{ ($completados / $totalGrupos) * 100 }}%"></div>
                    </div>
                    <p class="text-sm text-gray-600 text-right">{{ round(($completados / $totalGrupos) * 100) }}% completado</p>
                </div>

                @if(!$valido)
                    <div class="mt-6 p-4 bg-yellow-50 rounded-lg">
                        <h4 class="text-lg font-semibold text-yellow-800 mb-2">Evaluaciones Pendientes</h4>
                        <ul class="space-y-2">
                            @foreach($inscripciones->where('estado', 0) as $inscripcion)
                                <li class="text-sm text-yellow-700">
                                    {{ $inscripcion->grupo->profesor->user->name }} - 
                                    {{ $inscripcion->grupo->asignatura->nombre }} 
                                    ({{ $inscripcion->grupo->nombre }})
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="text-center text-sm text-gray-600">
                <p class="font-semibold mb-1">Secretaría de Planeación DGCCH</p>
                <p>Este documento es una validación oficial del sistema CAD</p>
                <p>Fecha de validación: {{ now()->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>
    </div>
</body>
</html> 