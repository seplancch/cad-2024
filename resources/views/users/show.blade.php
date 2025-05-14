<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Detalles del Usuario: {{ $user->name }}</h2>
                        <div class="space-x-2">
                            <a href="{{ route('users.edit', $user) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Editar Usuario
                            </a>
                            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Volver a Usuarios
                            </a>
                        </div>
                    </div>

                    <!-- Información básica -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Información Básica</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nombre de Usuario</p>
                                <p class="mt-1">{{ $user->username }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Correo Electrónico</p>
                                <p class="mt-1">{{ $user->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nombre Completo</p>
                                <p class="mt-1">{{ $user->nombre }} {{ $user->apaterno }} {{ $user->amaterno }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tipo de Usuario</p>
                                <p class="mt-1">
                                    @switch($user->tipo)
                                        @case('A')
                                            Alumno
                                            @break
                                        @case('P')
                                            Profesor
                                            @break
                                        @case('E')
                                            Empleado
                                            @break
                                        @default
                                            No especificado
                                    @endswitch
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Roles</p>
                                <div class="mt-1 flex flex-wrap gap-2">
                                    @foreach($user->roles as $role)
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                            {{ $role }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información específica según tipo -->
                    @if($user->tipo === 'A')
                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Información del Alumno</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Número de Cuenta</p>
                                    <p class="mt-1">{{ $user->alumno->numero_cuenta ?? 'No especificado' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Fecha de Nacimiento</p>
                                    <p class="mt-1">{{ $user->alumno->fecha_nacimiento ? $user->alumno->fecha_nacimiento->format('d/m/Y') : 'No especificada' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Sexo</p>
                                    <p class="mt-1">
                                        @if($user->alumno && $user->alumno->sexo)
                                            {{ $user->alumno->sexo === 'M' ? 'Masculino' : 'Femenino' }}
                                        @else
                                            No especificado
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Plantel</p>
                                    <p class="mt-1">{{ $user->alumno->plantel->nombre ?? 'No especificado' }}</p>
                                </div>
                            </div>
                        </div>
                    @elseif($user->tipo === 'P')
                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Información del Profesor</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Número de Trabajador</p>
                                    <p class="mt-1">{{ $user->profesor->numero_trabajador ?? 'No especificado' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">RFC</p>
                                    <p class="mt-1">{{ $user->profesor->rfc ?? 'No especificado' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Fecha de Nacimiento</p>
                                    <p class="mt-1">{{ $user->profesor->fecha_nacimiento ? $user->profesor->fecha_nacimiento->format('d/m/Y') : 'No especificada' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Sexo</p>
                                    <p class="mt-1">
                                        @if($user->profesor && $user->profesor->sexo)
                                            {{ $user->profesor->sexo === 'M' ? 'Masculino' : 'Femenino' }}
                                        @else
                                            No especificado
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Plantel</p>
                                    <p class="mt-1">{{ $user->profesor->plantel->nombre ?? 'No especificado' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Turno</p>
                                    <p class="mt-1">
                                        @if($user->profesor && $user->profesor->turno)
                                            {{ $user->profesor->turno === 'M' ? 'Matutino' : 'Vespertino' }}
                                        @else
                                            No especificado
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Información de auditoría -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Información de Auditoría</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Fecha de Registro</p>
                                <p class="mt-1">{{ $user->created_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Última Actualización</p>
                                <p class="mt-1">{{ $user->updated_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 