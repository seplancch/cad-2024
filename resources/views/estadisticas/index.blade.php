<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estadísticas CAD') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtro de Plantel -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6">
                <form method="GET" action="{{ route('estadisticas.index') }}" class="flex items-center space-x-4">
                    <div class="flex-1">
                        <label for="plantel_id" class="block text-sm font-medium text-gray-700">Filtrar por Plantel</label>
                        <select name="plantel_id" id="plantel_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="">Todos los planteles</option>
                            @foreach($planteles as $plantel)
                                <option value="{{ $plantel->id }}" {{ $plantelSeleccionado == $plantel->id ? 'selected' : '' }}>
                                    {{ $plantel->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition">
                            Filtrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Resumen General -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                @foreach($estadisticas as $estadistica)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $estadistica->plantel_nombre }}</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <p class="text-sm text-gray-600">Total Alumnos</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $estadistica->total_alumnos }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-600">Completados</p>
                                <p class="text-2xl font-bold text-green-600">{{ $estadistica->alumnos_completados }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-600">Pendientes</p>
                                <p class="text-2xl font-bold text-red-600">{{ $estadistica->alumnos_pendientes }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-600">Progreso</p>
                                <p class="text-2xl font-bold text-blue-600">
                                    {{ $estadistica->total_alumnos > 0 ? round(($estadistica->alumnos_completados / $estadistica->total_alumnos) * 100, 1) : 0 }}%
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Gráficos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Gráfico por Semestre -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Progreso por Semestre</h3>
                    <canvas id="graficoSemestre" height="300"></canvas>
                </div>

                <!-- Gráfico de Progreso Diario -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Progreso Diario</h3>
                    <canvas id="graficoProgreso" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos para el gráfico por semestre
        const datosSemestre = {
            labels: {!! json_encode($estadisticasSemestre->pluck('numero_semestre')) !!},
            datasets: [{
                label: 'Alumnos Completados',
                data: {!! json_encode($estadisticasSemestre->pluck('alumnos_completados')) !!},
                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                borderColor: 'rgb(59, 130, 246)',
                borderWidth: 1
            }, {
                label: 'Total Alumnos',
                data: {!! json_encode($estadisticasSemestre->pluck('total_alumnos')) !!},
                backgroundColor: 'rgba(156, 163, 175, 0.5)',
                borderColor: 'rgb(156, 163, 175)',
                borderWidth: 1
            }]
        };

        // Datos para el gráfico de progreso diario
        const datosProgreso = {
            labels: {!! json_encode($progresoDiario->pluck('fecha')) !!},
            datasets: [{
                label: 'Alumnos Completados',
                data: {!! json_encode($progresoDiario->pluck('completados')) !!},
                backgroundColor: 'rgba(16, 185, 129, 0.5)',
                borderColor: 'rgb(16, 185, 129)',
                borderWidth: 1,
                fill: true
            }]
        };

        // Configuración común para los gráficos
        const configComun = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        };

        // Crear gráfico por semestre
        new Chart(document.getElementById('graficoSemestre'), {
            type: 'bar',
            data: datosSemestre,
            options: configComun
        });

        // Crear gráfico de progreso diario
        new Chart(document.getElementById('graficoProgreso'), {
            type: 'line',
            data: datosProgreso,
            options: {
                ...configComun,
                elements: {
                    line: {
                        tension: 0.4
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout> 