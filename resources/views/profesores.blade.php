<x-app-layout>
<!-- Adds the Core Table Styles -->

@rappasoftTableStyles
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profesores') }}
        </h2>
    </x-slot>
    <livewire:profesores-table />
    <livewire:scripts />
    <script src="https://unpkg.com/@nextapps-be/livewire-sortablejs@0.1.1/dist/livewire-sortable.js"></script>
</x-app-layout>
