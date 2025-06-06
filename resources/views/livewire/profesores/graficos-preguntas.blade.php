@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Gráficos de Respuestas por Pregunta</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($chartData as $preguntaId => $data)
           {{  dd($data) }}
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-lg font-semibold mb-4">Pregunta ID: {{ $preguntaId }}</h3>
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
                    labels: {!! json_encode(array_column($data->toArray(), 'label')) !!},
                    datasets: [{
                        data: {!! json_encode(array_column($data->toArray(), 'value')) !!},
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
