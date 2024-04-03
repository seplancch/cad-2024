<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>¡Ups!</strong> Hubo algunos problemas con tu entrada.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-4">
                                <x-label>Name:</x-label>
                                <x-input type="text" value="{{ $user->name }}" name="name" class="form-control"
                                    placeholder="Name" />
                        </div>
                        <div class="mb-4">
                                <x-label>Email:</x-label>
                                <x-input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                    placeholder="Email" />
                        </div>
                        <div class="mb-4">
                                <x-label>Password:</x-label>
                                <x-input type="password" name="password" class="form-control"
                                    placeholder="Password" />
                        </div>
                        <div class="mb-4">
                                <x-label>Confirm Password:</x-label>
                                <x-input type="password" name="confirm-password" class="form-control"
                                    placeholder="Confirm Password" />
                        </div>
                        <div class="mb-4">
                                <x-label>Role:</x-label>
                                <select class="form-control multiple" multiple name="roles[]">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>

                        </div>
                        <div class="mb-4">
                            <x-button type="submit" class="btn btn-primary">{{__('Save')}}</x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
