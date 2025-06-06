@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center">
    <div class="w-full max-w-7xl p-8 bg-white rounded shadow-md mt-10">
        <h2 class="text-2xl font-bold text-center text-green-700 mb-6">Promedios del Grupo</h2>
        <livewire:promedios-grupos-profesor :grupoId="$grupoId" />
    </div>
</div>
@endsection
