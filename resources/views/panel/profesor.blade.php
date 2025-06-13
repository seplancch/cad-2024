@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center py-10">
    <div class="w-full max-w-7xl p-8 bg-white rounded shadow-md">
        <div class=" border-gray-300 mt-2 pt-2">
            <livewire:grupos-profesor />
        </div>
    </div>
</div>
@endsection
