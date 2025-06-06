@extends('layouts.app')

@section('content')
<div class="min-h-screen py-10">
    <div class="container mx-auto px-4">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-3xl font-bold text-center text-blue-800 mb-6">Panel de Profesor</h2>
            <div class="border-t border-gray-300 mt-4 pt-4">
                <livewire:grupos-profesor />
            </div>
        </div>
    </div>
</div>
@endsection
