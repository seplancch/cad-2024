@extends('inicio.layouts.app')

@section('content')
    <div class="w-full max-w-lg max-w-screen-md mx-auto pt-10 animate-fade animate-ease-in-out animate-duration-1000">
        <h3 class="animate-fade-left">Contacto</h3>

        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form class="max-w-sm mx-auto mt-5" method="POST" action="{{ route('contacto.enviar') }}">
            @csrf
            
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Ingresa tu correo</label>
            <div class="relative mb-6">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                        <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                    </svg>
                </div>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 @error('email') border-red-500 @enderror" 
                       placeholder="nombre@cch.unam.mx">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <label for="mensaje" class="block mb-2 text-sm font-medium text-gray-900">Escribe tu mensaje</label>
            <textarea id="mensaje" 
                      name="mensaje" 
                      rows="4" 
                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('mensaje') border-red-500 @enderror" 
                      placeholder="Deja un comentario...">{{ old('mensaje') }}</textarea>
            @error('mensaje')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <button type="submit" 
                    class="text-white bg-blue hover:bg-green focus:ring-4 focus:outline-none focus:ring-blue font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mt-5">
                Enviar
            </button>
        </form>
    </div>
@endsection
