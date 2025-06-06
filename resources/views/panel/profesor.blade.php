@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center py-10">
    <div class="w-full max-w-7xl p-8 bg-white rounded shadow-md">
        <h2 class="text-3xl font-bold text-center text-blue-800 mb-6">Panel de Profesor</h2>
        <div class="border-t border-gray-300 mt-4 pt-4">
            <livewire:grupos-profesor />
        </div>
    </div>
</div>
@endsection
