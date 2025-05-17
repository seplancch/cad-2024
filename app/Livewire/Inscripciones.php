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
    public $searchAlumno = '';
    public $searchGrupo = '';
    public $searchPeriodo = '';
    public $alumnosFiltrados = [];
    public $gruposFiltrados = [];
    public $periodosFiltrados = [];
    public $selectedAlumnoIndex = -1;
    public $selectedGrupoIndex = -1;
    public $selectedPeriodoIndex = -1;

    protected $rules = [
        'alumno_id' => 'required|exists:alumnos,id',
        'grupo_id' => 'required|exists:grupos,id',
        'activa' => 'required|boolean',
        'estado' => 'required|integer',
        'periodo_id' => 'required|exists:periodos,id',
        'autoinscripcion' => 'required|boolean',
    ];

    protected $listeners = [];

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
        $this->searchAlumno = '';
        $this->searchGrupo = '';
        $this->searchPeriodo = '';
        $this->alumnosFiltrados = [];
        $this->gruposFiltrados = [];
        $this->periodosFiltrados = [];
        $this->selectedAlumnoIndex = -1;
        $this->selectedGrupoIndex = -1;
        $this->selectedPeriodoIndex = -1;
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
        
        // Establecer los valores de búsqueda
        $this->searchAlumno = $inscripcion->alumno->user->name;
        $this->searchGrupo = $inscripcion->grupo->nombre . ' - ' . $inscripcion->grupo->seccion;
        $this->searchPeriodo = Periodo::find($inscripcion->periodo_id)->nombre;
        
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

    public function keydown(string $key)
    {
        if ($key === 'ArrowDown') {
            if ($this->searchAlumno && count($this->alumnosFiltrados) > 0) {
                $this->selectedAlumnoIndex = min($this->selectedAlumnoIndex + 1, count($this->alumnosFiltrados) - 1);
            } elseif ($this->searchGrupo && count($this->gruposFiltrados) > 0) {
                $this->selectedGrupoIndex = min($this->selectedGrupoIndex + 1, count($this->gruposFiltrados) - 1);
            } elseif ($this->searchPeriodo && count($this->periodosFiltrados) > 0) {
                $this->selectedPeriodoIndex = min($this->selectedPeriodoIndex + 1, count($this->periodosFiltrados) - 1);
            }
        } elseif ($key === 'ArrowUp') {
            if ($this->searchAlumno && count($this->alumnosFiltrados) > 0) {
                $this->selectedAlumnoIndex = max($this->selectedAlumnoIndex - 1, 0);
            } elseif ($this->searchGrupo && count($this->gruposFiltrados) > 0) {
                $this->selectedGrupoIndex = max($this->selectedGrupoIndex - 1, 0);
            } elseif ($this->searchPeriodo && count($this->periodosFiltrados) > 0) {
                $this->selectedPeriodoIndex = max($this->selectedPeriodoIndex - 1, 0);
            }
        } elseif ($key === 'Enter') {
            if ($this->searchAlumno && $this->selectedAlumnoIndex >= 0 && isset($this->alumnosFiltrados[$this->selectedAlumnoIndex])) {
                $this->selectAlumno($this->alumnosFiltrados[$this->selectedAlumnoIndex]->id);
            } elseif ($this->searchGrupo && $this->selectedGrupoIndex >= 0 && isset($this->gruposFiltrados[$this->selectedGrupoIndex])) {
                $this->selectGrupo($this->gruposFiltrados[$this->selectedGrupoIndex]->id);
            } elseif ($this->searchPeriodo && $this->selectedPeriodoIndex >= 0 && isset($this->periodosFiltrados[$this->selectedPeriodoIndex])) {
                $this->selectPeriodo($this->periodosFiltrados[$this->selectedPeriodoIndex]->id);
            }
        } elseif ($key === 'Escape') {
            $this->alumnosFiltrados = [];
            $this->gruposFiltrados = [];
            $this->periodosFiltrados = [];
            $this->selectedAlumnoIndex = -1;
            $this->selectedGrupoIndex = -1;
            $this->selectedPeriodoIndex = -1;
        }
    }

    public function updatedSearchAlumno()
    {
        if (strlen($this->searchAlumno) >= 2) {
            $this->alumnosFiltrados = Alumno::whereHas('user', function($query) {
                $query->where('name', 'like', '%' . $this->searchAlumno . '%');
            })->take(5)->get();
        } else {
            $this->alumnosFiltrados = [];
            $this->alumno_id = null;
        }
    }

    public function updatedSearchGrupo()
    {
        if (strlen($this->searchGrupo) >= 2) {
            $this->gruposFiltrados = Grupo::where('periodo_id', $this->periodo_id)
                ->where(function($query) {
                    $query->where('nombre', 'like', '%' . $this->searchGrupo . '%')
                          ->orWhere('seccion', 'like', '%' . $this->searchGrupo . '%')
                          ->orWhereHas('asignatura', function($q) {
                              $q->where('nombre', 'like', '%' . $this->searchGrupo . '%');
                          });
                })
                ->take(5)
                ->get();
        } else {
            $this->gruposFiltrados = [];
            $this->grupo_id = null;
        }
    }

    public function updatedSearchPeriodo()
    {
        if (strlen($this->searchPeriodo) >= 2) {
            $this->periodosFiltrados = Periodo::where('nombre', 'like', '%' . $this->searchPeriodo . '%')
                ->take(5)
                ->get();
        } else {
            $this->periodosFiltrados = [];
            $this->periodo_id = null;
        }
    }

    public function selectAlumno($id)
    {
        $alumno = Alumno::find($id);
        if ($alumno) {
            $this->alumno_id = $id;
            $this->searchAlumno = $alumno->user->name;
            $this->alumnosFiltrados = [];
        }
    }

    public function selectGrupo($id)
    {
        $grupo = Grupo::find($id);
        if ($grupo) {
            $this->grupo_id = $id;
            $this->searchGrupo = $grupo->nombre . ' - ' . $grupo->seccion;
            $this->gruposFiltrados = [];
        }
    }

    public function selectPeriodo($id)
    {
        $periodo = Periodo::find($id);
        if ($periodo) {
            $this->periodo_id = $id;
            $this->searchPeriodo = $periodo->nombre;
            $this->periodosFiltrados = [];
        }
    }
} 