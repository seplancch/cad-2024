<?php

namespace App\Livewire;

use App\Models\Cuestionario;
use Livewire\Component;

class CuestionarioSelector extends Component
{
    public $cuestionarios;
    public $cuestionario_id = 0;

    public function mount()
    {
        $this->cuestionarios = Cuestionario::all();
    }

    public function obtieneId($id)
    {
        $this->cuestionario_id = $id;
        $this->dispatch('cuestionario_id', $id);
    }

    public function render()
    {
        return view('livewire.cuestionario-selector');
    }
}
