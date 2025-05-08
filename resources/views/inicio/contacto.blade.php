@extends('inicio.layouts.app')

@section('content')
    <div class="w-full max-w-lg max-w-screen-md mx-auto pt-10 animate-fade animate-ease-in-out animate-duration-1000">
        <h3 class="animate-fade-left">Contacto</h3>

        <form class="max-w-sm mx-auto mt-5">
        <label for="email-address-icon" class="block mb-2 text-sm font-medium text-gray-900 ">Ingresa tu correo</label>
        <div class="relative mb-6">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
            </svg>
            </div>
            <input type="text" id="email-address-icon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="nombre@cch.unam.mx">

        </div>
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 ">Escribe tu mensaje</label>
        <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600" placeholder="Deja un comentario..."></textarea>
        <button type="submit" class="text-white bg-blue hover:bg-green focus:ring-4 focus:outline-none focus:ring-blue font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mt-5 ">Enviar</button>

        </form>
    </div>
@endsection
