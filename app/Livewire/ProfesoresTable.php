<?php

namespace App\Livewire;

use App\Models\Profesor;
use Livewire\Component;
use Livewire\WithPagination;

class ProfesoresTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function delete($id)
    {
        $profesor = Profesor::find($id);
        if ($profesor) {
            $profesor->delete();
            session()->flash('message', 'Profesor eliminado correctamente.');
        }
    }

    public function render()
    {
        $profesores = Profesor::query()
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('numero_trabajador', 'like', '%' . $this->search . '%')
                      ->orWhere('rfc', 'like', '%' . $this->search . '%')
                      ->orWhereHas('user', function($q) {
                          $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.profesores-table', [
            'profesores' => $profesores
        ]);
    }
} 