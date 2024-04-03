
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Permiso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">


                <form action="{{ route('permissions.store') }}" method="POST">
                    @csrf

                    <x-label for="name">Nombre</x-label>
                    <x-input type="text" id="name" name="name" />

                    <x-input type="submit" value="Crear" />
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
