<!-- resources/views/permissions/index.blade.php -->


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permisos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <a href="{{ route('permissions.create') }}">Crear nuevo permiso</a>

                @foreach($permissions as $permission)
                    <div>
                        <p>{{ $permission->name }}</p>
                        <a href="{{ route('permissions.edit', $permission) }}">Editar</a>
                        <form method="POST" action="{{ route('permissions.destroy', $permission) }}">
                            @csrf
                            @method('DELETE')
                            <x-button type="submit">Eliminar</x-button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
