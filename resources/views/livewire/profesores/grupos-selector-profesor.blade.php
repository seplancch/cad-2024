<div class="mb-6 flex flex-col md:flex-row md:items-center md:space-x-4 space-y-2 md:space-y-0">
    <label for="grupoSelect" class="font-semibold text-blue-800">Mis grupos asignados:</label>
    <select id="grupoSelect" wire:model="grupoSeleccionado" class="border border-blue-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
        <option value="">Selecciona un grupo</option>
        <option value="all">Todos los grupos</option>
        @foreach($grupos as $grupo)
            <option value="{{ $grupo->id }}">{{ $grupo->nombre }} - {{ $grupo->seccion }}</option>
        @endforeach
    </select>
</div>
