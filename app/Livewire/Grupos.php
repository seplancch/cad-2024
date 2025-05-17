<?php

namespace App\Livewire;

use App\Models\Grupo;
use App\Models\Profesor;
use App\Models\Asignatura;
use App\Models\Plantel;
use App\Models\Periodo;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use function App\Helpers\obtieneIdPeriodoActual;

class Grupos extends Component
{
    use WithPagination;

    public $isModalOpen = false;
    public $isDeleteModalOpen = false;
    public $grupo_id;
    public $nombre;
    public $seccion;
    public $profesor_id;
    public $asignatura_id;
    public $plantel_id;
    public $periodo_id;
    public $grupoToDelete;
    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $filtroProfesor = '';
    public $filtroAsignatura = '';
    public $filtroPlantel = '';

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'seccion' => 'required|string|max:255',
        'profesor_id' => 'required|exists:profesores,id',
        'asignatura_id' => 'required|exists:asignaturas,id',
        'plantel_id' => 'required|exists:planteles,id',
        'periodo_id' => 'required|exists:periodos,id',
    ];

    public function mount()
    {
        $this->periodo_id = obtieneIdPeriodoActual();
    }

    public function render()
    {
        $grupos = Grupo::query()
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('nombre', 'like', '%' . $this->search . '%')
                      ->orWhere('seccion', 'like', '%' . $this->search . '%')
                      ->orWhereHas('profesor', function($q) {
                          $q->whereHas('user', function($q) {
                              $q->where('name', 'like', '%' . $this->search . '%');
                          });
                      })
                      ->orWhereHas('asignatura', function($q) {
                          $q->where('nombre', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->when($this->filtroProfesor, function($query) {
                $query->where('profesor_id', $this->filtroProfesor);
            })
            ->when($this->filtroAsignatura, function($query) {
                $query->where('asignatura_id', $this->filtroAsignatura);
            })
            ->when($this->filtroPlantel, function($query) {
                $query->where('plantel_id', $this->filtroPlantel);
            })
            ->where('periodo_id', $this->periodo_id)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.grupos.inicio', [
            'grupos' => $grupos,
            'periodos' => Periodo::all(),
            'profesores' => Profesor::all(),
            'asignaturas' => Asignatura::all(),
            'planteles' => Plantel::all(),
        ]);
    }

    public function create()
    {
        $this->resetValidation();
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputFields()
    {
        $this->grupo_id = null;
        $this->nombre = '';
        $this->seccion = '';
        $this->profesor_id = '';
        $this->asignatura_id = '';
        $this->plantel_id = '';
        $this->periodo_id = obtieneIdPeriodoActual();
    }

    public function store()
    {
        $this->validate();

        try {
            Grupo::updateOrCreate(['id' => $this->grupo_id], [
                'nombre' => $this->nombre,
                'seccion' => $this->seccion,
                'profesor_id' => $this->profesor_id,
                'asignatura_id' => $this->asignatura_id,
                'plantel_id' => $this->plantel_id,
                'periodo_id' => $this->periodo_id,
            ]);

            session()->flash('message', $this->grupo_id ? 'Grupo actualizado exitosamente.' : 'Grupo creado exitosamente.');
            $this->closeModal();
            $this->resetInputFields();
        } catch (\Exception $e) {
            Log::error('Error al guardar el grupo: ' . $e->getMessage());
            session()->flash('error', 'Error al guardar el grupo: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $grupo = Grupo::findOrFail($id);
        $this->grupo_id = $id;
        $this->nombre = $grupo->nombre;
        $this->seccion = $grupo->seccion;
        $this->profesor_id = $grupo->profesor_id;
        $this->asignatura_id = $grupo->asignatura_id;
        $this->plantel_id = $grupo->plantel_id;
        $this->periodo_id = $grupo->periodo_id;
        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->grupoToDelete = Grupo::findOrFail($id);
        $this->isDeleteModalOpen = true;
    }

    public function cancelDelete()
    {
        $this->isDeleteModalOpen = false;
        $this->grupoToDelete = null;
    }

    public function delete($id)
    {
        try {
            $grupo = Grupo::findOrFail($id);
            
            // Verificar si tiene inscripciones
            if ($grupo->inscripciones()->exists()) {
                session()->flash('error', 'No se puede eliminar el grupo porque tiene inscripciones asociadas.');
            } else {
                $grupo->delete();
                session()->flash('message', 'Grupo eliminado exitosamente.');
            }
        } catch (\Exception $e) {
            Log::error('Error al eliminar el grupo: ' . $e->getMessage());
            session()->flash('error', 'Error al eliminar el grupo: ' . $e->getMessage());
        }

        $this->isDeleteModalOpen = false;
        $this->grupoToDelete = null;
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

    public function updatedPerPage()
    {
        $this->resetPage();
    }
} 