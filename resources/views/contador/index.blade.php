<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        {{ __('Contador CAD') }}
                    </h2>
                </div>
            </div>

            <!-- Filtros -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6">
                <form method="GET" action="{{ route('contador.index') }}" class="flex items-center space-x-4">
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
                    <div class="flex-1">
                        <label for="semestre" class="block text-sm font-medium text-gray-700">Filtrar por Semestre</label>
                        <select name="semestre" id="semestre" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="">Todos los semestres</option>
                            @foreach($semestres as $semestre)
                                <option value="{{ $semestre }}" {{ $semestreSeleccionado == $semestre ? 'selected' : '' }}>
                                    {{ $semestre }}° Semestre
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

            <!-- Tabla de Contador -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Contador por Plantel y Semestre</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plantel</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semestre</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total Alumnos</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Completados</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Pendientes</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Progreso</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($estadisticas as $estadistica)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $estadistica->plantel_nombre }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $estadistica->numero_semestre }}° Semestre
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                            {{ $estadistica->total_alumnos }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-green-600 font-medium">
                                            {{ $estadistica->alumnos_completados }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-red-600 font-medium">
                                            {{ $estadistica->alumnos_pendientes }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            @php
                                                $porcentaje = $estadistica->total_alumnos > 0 
                                                    ? round(($estadistica->alumnos_completados / $estadistica->total_alumnos) * 100, 1) 
                                                    : 0;
                                            @endphp
                                            <div class="flex items-center justify-center">
                                                <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2">
                                                    <div class="h-2.5 rounded-full {{ $porcentaje == 100 ? 'bg-green-600' : ($porcentaje > 0 ? 'bg-yellow-500' : 'bg-gray-400') }}" 
                                                         style="width: {{ $porcentaje }}%"></div>
                                                </div>
                                                <span class="text-sm font-medium {{ $porcentaje == 100 ? 'text-green-600' : ($porcentaje > 0 ? 'text-yellow-600' : 'text-gray-600') }}">
                                                    {{ $porcentaje }}%
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout> 