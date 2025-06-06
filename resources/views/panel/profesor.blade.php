@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-green-50">
    <div class="w-full max-w-7xl p-8 bg-white rounded shadow-md mt-10">
        <h2 class="text-2xl font-bold text-center text-green-700 mb-6">Panel de Profesor</h2>
        <livewire:grupos-profesor :showSearch="false" :showPagination="false" />
        <div class="mt-10">
            <livewire:promedios-grupos-profesor />
        </div>
    </div>
</div>
@endsection
