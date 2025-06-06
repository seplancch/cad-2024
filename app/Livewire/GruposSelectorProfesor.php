<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class GruposSelectorProfesor extends Component
{
    public $grupos;
    public $grupoSeleccionado;

    public function updatedGrupoSeleccionado($value)
    {
        Log::info('GruposSelectorProfesor: updatedGrupoSeleccionado, emitiendo evento.', ['valor' => $value]);
        $this->emitUp('grupoSeleccionado', $value);
    }

    public function render()
    {
        return view('livewire.profesores.grupos-selector-profesor');
    }
}
