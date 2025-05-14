<!-- resources/views/roles/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Crear Nuevo Rol') }}
            </h2>
            <a href="{{ route('roles.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver a Roles
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Encabezado -->
                <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Información del Rol</h3>
                            <p class="mt-1 text-sm text-gray-600">Complete los datos para crear un nuevo rol en el sistema</p>
                        </div>
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Formulario -->
                <form action="{{ route('roles.store') }}" method="POST" class="p-6">
                    @csrf

                    <!-- Nombre del Rol -->
                    <div class="mb-6">
                        <x-label for="name" value="Nombre del Rol" class="block text-sm font-medium text-gray-700 mb-2" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <x-input type="text" 
                                    name="name" 
                                    id="name" 
                                    class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                    placeholder="Ej: Editor, Supervisor, etc."
                                    required />
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Permisos -->
                    <div class="mb-6">
                        <x-label value="Permisos" class="block text-sm font-medium text-gray-700 mb-2" />
                        <div class="mt-2 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($permissions as $permission)
                                    <div class="relative flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" 
                                                   name="permissions[]" 
                                                   value="{{ $permission->id }}"
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                                   id="permission_{{ $permission->id }}">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="permission_{{ $permission->id }}" class="font-medium text-gray-700">
                                                {{ $permission->name }}
                                            </label>
                                            <p class="text-gray-500">
                                                {{ ucfirst(str_replace('-', ' ', $permission->name)) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('permissions')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('roles.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Crear Rol
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Agrupar permisos por tipo
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name="permissions[]"]');
            const permissionGroups = {};
            
            checkboxes.forEach(checkbox => {
                const permissionName = checkbox.value;
                const group = permissionName.split('-')[0]; // Ej: 'user' de 'user-create'
                
                if (!permissionGroups[group]) {
                    permissionGroups[group] = [];
                }
                permissionGroups[group].push(checkbox);
            });

            // Agregar selectores de grupo
            Object.keys(permissionGroups).forEach(group => {
                const groupCheckboxes = permissionGroups[group];
                const groupContainer = groupCheckboxes[0].closest('.grid');
                
                // Crear checkbox para el grupo
                const groupDiv = document.createElement('div');
                groupDiv.className = 'col-span-full mb-4';
                groupDiv.innerHTML = `
                    <div class="relative flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded group-selector"
                                   data-group="${group}">
                        </div>
                        <div class="ml-3 text-sm">
                            <label class="font-medium text-gray-700">
                                ${group.charAt(0).toUpperCase() + group.slice(1)} - Todos los permisos
                            </label>
                        </div>
                    </div>
                `;
                
                groupContainer.insertBefore(groupDiv, groupCheckboxes[0].closest('.relative'));
                
                // Agregar evento al selector de grupo
                const groupSelector = groupDiv.querySelector('.group-selector');
                groupSelector.addEventListener('change', function() {
                    groupCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
                
                // Actualizar selector de grupo cuando cambian los checkboxes individuales
                groupCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        const allChecked = Array.from(groupCheckboxes).every(cb => cb.checked);
                        const someChecked = Array.from(groupCheckboxes).some(cb => cb.checked);
                        groupSelector.checked = allChecked;
                        groupSelector.indeterminate = someChecked && !allChecked;
                    });
                });
            });
        });
    </script>
    @endpush
</x-app-layout>

