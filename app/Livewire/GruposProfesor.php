<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;
use function App\Helpers\obtieneIdPeriodoActual;

class GruposProfesor extends Component
{
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $periodo_id;

    public function mount()
    {
        $this->periodo_id = obtieneIdPeriodoActual();
    }

    public function render()
    {
        $profesor = Auth::user()->profesor;
        $grupos = Grupo::with(['asignatura', 'plantel', 'periodo'])
            ->where('profesor_id', $profesor->id)
            ->where('periodo_id', $this->periodo_id)
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        return view('livewire.profesores.grupos-profesor', [
            'grupos' => $grupos
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
}
