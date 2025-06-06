@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center py-10">
    <div class="w-full max-w-7xl p-8 bg-white rounded shadow-md">
        <a href="{{ route('dashboard') }}" class="text-sm text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded shadow">&larr; Regresar</a>
        <h2 class="text-2xl font-bold text-center text-green-700 mb-6">Promedios del Grupo</h2>
        <livewire:promedios-grupos-profesor :grupoId="$grupoId" />
    </div>
</div>
@endsection
