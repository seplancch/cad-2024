<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
        <div class="text-center">
            <h1 class="text-7xl font-extrabold text-indigo-600 mb-4">404</h1>
            <h2 class="text-2xl md:text-3xl font-bold mb-2">Página no encontrada</h2>
            <p class="text-gray-600 mb-6">Lo sentimos, la página que buscas no existe o ha sido movida.</p>
            <a href="{{ url('/') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">Volver al inicio</a>
        </div>
        <div class="mt-10">
            <img src="{{ asset('img/404.png') }}" alt="404 Ilustración" class="w-80 mx-auto">
        </div>
    </div>
</x-guest-layout>
