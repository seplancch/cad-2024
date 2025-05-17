<?php

namespace App\Livewire;

use App\Models\Inscripcion;
use App\Models\Grupo;
use App\Models\Alumno;
use App\Models\Periodo;
use App\Models\Asignatura;
use App\Models\Plantel;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use function App\Helpers\obtieneIdPeriodoActual;

class Inscripciones extends Component
{
    use WithPagination;

    public $isModalOpen = false;
    public $isDeleteModalOpen = false;
    public $inscripcion_id;
    public $alumno_id;
    public $grupo_id;
    public $activa = 1;
    public $estado = 0;
    public $periodo_id;
    public $autoinscripcion = 0;
    public $inscripcionToDelete;
    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $filtroGrupo = '';
    public $filtroAsignatura = '';
    public $filtroPlantel = '';

    protected $rules = [
        'alumno_id' => 'required|exists:alumnos,id',
        'grupo_id' => 'required|exists:grupos,id',
        'activa' => 'required|boolean',
        'estado' => 'required|integer',
        'periodo_id' => 'required|exists:periodos,id',
        'autoinscripcion' => 'required|boolean',
    ];

    public function mount()
    {
        $this->periodo_id = obtieneIdPeriodoActual();
    }

    public function render()
    {
        $inscripciones = Inscripcion::query()
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->whereHas('alumno', function($q) {
                        $q->whereHas('user', function($q) {
                            $q->where('name', 'like', '%' . $this->search . '%');
                        });
                    })
                    ->orWhereHas('grupo', function($q) {
                        $q->where('nombre', 'like', '%' . $this->search . '%')
                          ->orWhere('seccion', 'like', '%' . $this->search . '%');
                    });
                });
            })
            ->when($this->filtroGrupo, function($query) {
                $query->where('grupo_id', $this->filtroGrupo);
            })
            ->when($this->filtroAsignatura, function($query) {
                $query->whereHas('grupo', function($q) {
                    $q->where('asignatura_id', $this->filtroAsignatura);
                });
            })
            ->when($this->filtroPlantel, function($query) {
                $query->whereHas('grupo', function($q) {
                    $q->where('plantel_id', $this->filtroPlantel);
                });
            })
            ->where('periodo_id', $this->periodo_id)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.inscripciones.inicio', [
            'inscripciones' => $inscripciones,
            'periodos' => Periodo::all(),
            'grupos' => Grupo::where('periodo_id', $this->periodo_id)->get(),
            'alumnos' => Alumno::all(),
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
        $this->inscripcion_id = null;
        $this->alumno_id = '';
        $this->grupo_id = '';
        $this->activa = 1;
        $this->estado = 0;
        $this->periodo_id = obtieneIdPeriodoActual();
        $this->autoinscripcion = 0;
    }

    public function store()
    {
        $this->validate();

        try {
            Inscripcion::updateOrCreate(['id' => $this->inscripcion_id], [
                'alumno_id' => $this->alumno_id,
                'grupo_id' => $this->grupo_id,
                'activa' => $this->activa,
                'estado' => $this->estado,
                'periodo_id' => $this->periodo_id,
                'autoinscripcion' => $this->autoinscripcion,
            ]);

            session()->flash('message', $this->inscripcion_id ? 'Inscripción actualizada exitosamente.' : 'Inscripción creada exitosamente.');
            $this->closeModal();
            $this->resetInputFields();
        } catch (\Exception $e) {
            Log::error('Error al guardar la inscripción: ' . $e->getMessage());
            session()->flash('error', 'Error al guardar la inscripción: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $this->inscripcion_id = $id;
        $this->alumno_id = $inscripcion->alumno_id;
        $this->grupo_id = $inscripcion->grupo_id;
        $this->activa = $inscripcion->activa;
        $this->estado = $inscripcion->estado;
        $this->periodo_id = $inscripcion->periodo_id;
        $this->autoinscripcion = $inscripcion->autoinscripcion;
        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->inscripcionToDelete = Inscripcion::findOrFail($id);
        $this->isDeleteModalOpen = true;
    }

    public function cancelDelete()
    {
        $this->isDeleteModalOpen = false;
        $this->inscripcionToDelete = null;
    }

    public function delete($id)
    {
        try {
            $inscripcion = Inscripcion::findOrFail($id);
            
            // Verificar si tiene resultados
            if ($inscripcion->resultados()->exists()) {
                session()->flash('error', 'No se puede eliminar la inscripción porque tiene resultados asociados.');
            } else {
                $inscripcion->delete();
                session()->flash('message', 'Inscripción eliminada exitosamente.');
            }
        } catch (\Exception $e) {
            Log::error('Error al eliminar la inscripción: ' . $e->getMessage());
            session()->flash('error', 'Error al eliminar la inscripción: ' . $e->getMessage());
        }

        $this->isDeleteModalOpen = false;
        $this->inscripcionToDelete = null;
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