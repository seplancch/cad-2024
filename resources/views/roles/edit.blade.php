<!-- resources/views/roles/edit.blade.php -->


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Rol') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <form action="{{ route('roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" value="{{ $role->name }}">

                    <input type="submit" value="Actualizar">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
