@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-6">
    <div class="flex justify-between items-center mb-6 mt-6">
        <a href="{{ route('dashboard') }}" class="text-sm text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded shadow">&larr; Regresar</a>
        <h2 class="text-3xl font-bold text-blue-700">Análisis de Respuestas por Pregunta</h2>
    </div>
    <div class="bg-gray-100 p-4 rounded-lg shadow mb-6">
        <p class="text-lg font-semibold text-gray-700">Grupo: <span class="text-blue-600">{{ $grupo->nombre ?? 'Sin nombre' }}</span></p>
        <p class="text-lg font-semibold text-gray-700">Asignatura: <span class="text-green-600">{{ $asignatura }}</span></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($chartData as $preguntaId => $data)
            <div class="bg-gray-50 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $data['titulo'] }}</h3>
                <canvas id="chart-{{ $preguntaId }}"></canvas>
            </div>
        @endforeach
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @foreach ($chartData as $preguntaId => $data)
            const ctx{{ $preguntaId }} = document.getElementById('chart-{{ $preguntaId }}').getContext('2d');
            new Chart(ctx{{ $preguntaId }}, {
                type: 'pie',
                data: {
                    labels: {!! json_encode(array_column($data['respuestas']->toArray(), 'label')) !!},
                    datasets: [{
                        data: {!! json_encode(array_column($data['respuestas']->toArray(), 'value')) !!},
                        backgroundColor: [
                            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });
        @endforeach
    });
</script>
