<div id="selectorCuestionario">

        <x-label for="cuestionario">Selecciona un cuestionario</x-label>
        <x-select-list name="cuestionario" id="cuestionario" wire:model="cuestionario_id">
            @foreach($cuestionarios as $cuestionario)
                <option value="{{ $cuestionario->id }}" wire:key="{{ $cuestionario->id }}" wire:click="obtieneId({{$cuestionario->id}})">{{ $cuestionario->titulo }}</option>
            @endforeach
        </x-select-list>
</div>
