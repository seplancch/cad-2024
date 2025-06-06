@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-white">
    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl border border-blue-100">
        <div class="flex flex-col items-center mb-6">
            <div class="bg-blue-100 rounded-full p-4 mb-2">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14c4.418 0 8 1.79 8 4v2H4v-2c0-2.21 3.582-4 8-4zm0-4a4 4 0 100-8 4 4 0 000 8z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-blue-800 mb-1">Acceso Profesores</h2>
            <p class="text-gray-500 text-sm">Ingresa tus credenciales institucionales</p>
        </div>
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div>
                <label for="username" class="block text-gray-700 font-semibold mb-1">Usuario</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" placeholder="Usuario o RFC">
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-1">Contraseña</label>
                <input id="password" type="password" name="password" required class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" placeholder="********">
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="rounded border-blue-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-200">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Recordarme</label>
                </div>
                <a class="text-sm text-blue-700 hover:underline font-medium" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            </div>
            <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 rounded-lg shadow transition">Ingresar</button>
        </form>
    </div>
</div>
@endsection
