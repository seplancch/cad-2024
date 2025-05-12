<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Validación - CAD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full">
            <div class="text-center mb-8">
                <div class="flex justify-center items-center space-x-8 mb-4">
                    <img src="{{ asset('img/unam.svg') }}" alt="UNAM" class="h-16">
                    <img src="{{ asset('img/cch.svg') }}" alt="CCH" class="h-16">
                    <img src="{{ asset('img/seplan_logo.png') }}" alt="CAD" class="h-16">
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mt-4">Error en la Validación</h1>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-center mb-6">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-red-100 text-red-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span class="font-semibold">{{ $mensaje }}</span>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-gray-600 mb-4">{{ $detalles }}</p>
                    <p class="text-sm text-gray-500">Por favor, verifica el código de validación e intenta nuevamente.</p>
                </div>
            </div>

            <div class="text-center text-sm text-gray-600 mt-6">
                <p class="font-semibold mb-1">Secretaría de Planeación DGCCH</p>
                <p>Este documento es una validación oficial del sistema CAD</p>
                <p>Fecha de validación: {{ now()->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>
    </div>
</body>
</html> 