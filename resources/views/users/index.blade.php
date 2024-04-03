<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success my-2">
                        <p>{{ $message }}</p>
                    </div>
                @endif


                <x-table class="table table-bordered table-hover table-striped">
                    <x-slot name="head">
                        <tr>
                            <th class="px-4 py-3 text-left rtl:text-right">{{__('Name')}}</th>
                            <th class="px-4 py-3 text-left rtl:text-right">{{__('Email')}}</th>
                            <th class="px-4 py-3 text-left rtl:text-right">{{__('Roles')}}</th>
                            <th class="px-4 py-3 text-left rtl:text-right">{{__('Action')}}</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($users as $key => $user)
                        <tr>
                            <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $user->name }}</td>
                            <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $user->email }}</td>
                            <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                <x-label class="badge badge-secondary text-dark">{{ $v }}</x-label>
                                @endforeach
                            @endif
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">
                                <a class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ route('users.show',$user->id) }}">{{__('Show')}}</a>
                                <a class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" href="{{ route('users.edit',$user->id) }}">{{__('Edit')}}</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Borrar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </x-slot>
                </x-table>
                <div class="py-4 px-3">
                    <div class="flex">
                       {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
