<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nuevo Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Crear Nuevo Usuario</h2>
                        <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Volver a Usuarios
                        </a>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">¡Error!</strong>
                            <ul class="mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Información básica del usuario -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Información Básica</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-700">Nombre de Usuario *</label>
                                    <input type="text" name="username" id="username" value="{{ old('username') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico *</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre *</label>
                                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="apaterno" class="block text-sm font-medium text-gray-700">Apellido Paterno *</label>
                                    <input type="text" name="apaterno" id="apaterno" value="{{ old('apaterno') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="amaterno" class="block text-sm font-medium text-gray-700">Apellido Materno</label>
                                    <input type="text" name="amaterno" id="amaterno" value="{{ old('amaterno') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña *</label>
                                    <input type="password" name="password" id="password" required minlength="8"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <p class="mt-1 text-sm text-gray-500">La contraseña debe tener al menos 8 caracteres</p>
                                </div>
                                <div>
                                    <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirmar Contraseña *</label>
                                    <input type="password" name="confirm-password" id="confirm-password" required minlength="8"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>
                        </div>

                        <!-- Tipo de usuario y roles -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Tipo de Usuario y Roles</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de Usuario (Opcional)</label>
                                    <select name="tipo" id="tipo" onchange="toggleUserTypeFields()"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Seleccione un tipo (opcional)</option>
                                        <option value="A" {{ old('tipo') == 'A' ? 'selected' : '' }}>Alumno</option>
                                        <option value="P" {{ old('tipo') == 'P' ? 'selected' : '' }}>Profesor</option>
                                        <option value="E" {{ old('tipo') == 'E' ? 'selected' : '' }}>Empleado</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="roles" class="block text-sm font-medium text-gray-700">Roles *</label>
                                    <select name="roles[]" id="roles" multiple required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @foreach($roles as $name => $value)
                                            <option value="{{ $name }}" {{ in_array($name, old('roles', [])) ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Campos específicos para Alumno -->
                        <div id="alumno-fields" class="bg-gray-50 p-4 rounded-lg hidden">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Información del Alumno</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="numero_cuenta" class="block text-sm font-medium text-gray-700">Número de Cuenta</label>
                                    <input type="text" name="numero_cuenta" id="numero_cuenta" value="{{ old('numero_cuenta') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="fecha_nacimiento_alumno" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                                    <input type="date" name="fecha_nacimiento_alumno" id="fecha_nacimiento_alumno" value="{{ old('fecha_nacimiento_alumno') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="sexo_alumno" class="block text-sm font-medium text-gray-700">Sexo</label>
                                    <select name="sexo_alumno" id="sexo_alumno"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Seleccione</option>
                                        <option value="M" {{ old('sexo_alumno') == 'M' ? 'selected' : '' }}>Masculino</option>
                                        <option value="F" {{ old('sexo_alumno') == 'F' ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="plantel_id_alumno" class="block text-sm font-medium text-gray-700">Plantel</label>
                                    <select name="plantel_id_alumno" id="plantel_id_alumno"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Seleccione un plantel</option>
                                        @foreach($planteles as $plantel)
                                            <option value="{{ $plantel->id }}" {{ old('plantel_id_alumno') == $plantel->id ? 'selected' : '' }}>
                                                {{ $plantel->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Campos específicos para Profesor -->
                        <div id="profesor-fields" class="bg-gray-50 p-4 rounded-lg hidden">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Información del Profesor</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="numero_trabajador" class="block text-sm font-medium text-gray-700">Número de Trabajador</label>
                                    <input type="text" name="numero_trabajador" id="numero_trabajador" value="{{ old('numero_trabajador') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="rfc" class="block text-sm font-medium text-gray-700">RFC</label>
                                    <input type="text" name="rfc" id="rfc" value="{{ old('rfc') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="fecha_nacimiento_profesor" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                                    <input type="date" name="fecha_nacimiento_profesor" id="fecha_nacimiento_profesor" value="{{ old('fecha_nacimiento_profesor') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="sexo_profesor" class="block text-sm font-medium text-gray-700">Sexo</label>
                                    <select name="sexo_profesor" id="sexo_profesor"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Seleccione</option>
                                        <option value="M" {{ old('sexo_profesor') == 'M' ? 'selected' : '' }}>Masculino</option>
                                        <option value="F" {{ old('sexo_profesor') == 'F' ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="plantel_id_profesor" class="block text-sm font-medium text-gray-700">Plantel</label>
                                    <select name="plantel_id_profesor" id="plantel_id_profesor"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Seleccione un plantel</option>
                                        @foreach($planteles as $plantel)
                                            <option value="{{ $plantel->id }}" {{ old('plantel_id_profesor') == $plantel->id ? 'selected' : '' }}>
                                                {{ $plantel->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="turno" class="block text-sm font-medium text-gray-700">Turno</label>
                                    <select name="turno" id="turno"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="M" {{ old('turno') == 'M' ? 'selected' : '' }}>Matutino</option>
                                        <option value="V" {{ old('turno') == 'V' ? 'selected' : '' }}>Vespertino</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Crear Usuario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Función para mostrar/ocultar campos según el tipo de usuario
            window.toggleUserTypeFields = function() {
                const tipo = document.getElementById('tipo').value;
                const alumnoFields = document.getElementById('alumno-fields');
                const profesorFields = document.getElementById('profesor-fields');

                // Ocultar todos los campos específicos
                alumnoFields.classList.add('hidden');
                profesorFields.classList.add('hidden');

                // Mostrar los campos según el tipo seleccionado
                if (tipo === 'A') {
                    alumnoFields.classList.remove('hidden');
                } else if (tipo === 'P') {
                    profesorFields.classList.remove('hidden');
                }
            };

            // Validación del formulario
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                const password = document.getElementById('password');
                const confirmPassword = document.getElementById('confirm-password');
                const roles = document.getElementById('roles');

                // Validar que se haya seleccionado al menos un rol
                if (roles.selectedOptions.length === 0) {
                    event.preventDefault();
                    alert('Debe seleccionar al menos un rol');
                    return;
                }

                // Validar que las contraseñas coincidan
                if (password.value !== confirmPassword.value) {
                    event.preventDefault();
                    alert('Las contraseñas no coinciden');
                    return;
                }

                // Validar longitud mínima de contraseña
                if (password.value.length < 8) {
                    event.preventDefault();
                    alert('La contraseña debe tener al menos 8 caracteres');
                    return;
                }
            });

            // Ejecutar al cargar la página para manejar el estado inicial
            toggleUserTypeFields();
        });
    </script>
    @endpush
</x-app-layout>
