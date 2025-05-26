<div>
    <h2 class="text-2xl font-bold mb-4">Reportes de Desempeño y Estadísticas</h2>
    <!-- Ejemplo de tabla global de inscripciones -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold mb-2">Inscripciones Globales</h3>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Total Alumnos</th>
                    <th class="px-4 py-2 border">Completaron</th>
                    <th class="px-4 py-2 border">No Completaron</th>
                    <th class="px-4 py-2 border">% Completaron</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-2 border">{{ $totalAlumnos ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $completaron ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $noCompletaron ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $porcentajeCompletaron ?? '-' }}%</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Ejemplo de gráfica de pastel (Chart.js) -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold mb-2">Distribución de Inscripciones</h3>
        <canvas id="graficaInscripciones" width="400" height="200"></canvas>
    </div>

    <!-- Aquí puedes agregar más tablas y gráficas por plantel, semestre, rubro, etc. -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('graficaInscripciones').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Completaron', 'No completaron'],
                    datasets: [{
                        data: [{{ $completaron ?? 0 }}, {{ $noCompletaron ?? 0 }}],
                        backgroundColor: ['#34d399', '#f87171'],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        });
    </script>
</div>
