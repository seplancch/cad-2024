<?php

namespace App\Livewire;

use Livewire\Component;

class GruposSelectorProfesor extends Component
{
    public $grupos;
    public $grupoSeleccionado;

    public function updatedGrupoSeleccionado($value)
    {
        $this->emitUp('grupoSeleccionado', $value);
    }

    public function render()
    {
        return view('livewire.profesores.grupos-selector-profesor');
    }
}
