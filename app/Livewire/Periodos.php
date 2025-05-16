<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Periodo;
use App\Models\Cuestionario;

class Periodos extends Component
{
    public $periodos;
    public $cuestionarios;

    #[Validate('required|exists:cuestionarios,id', as: 'cuestionario')]
    public $cuestionario_id;

    #[Validate('required|min:3')]
    public $clave;

    public $descripcion;
    public $periodo_id;
    public $isModalOpen = false;
    public $isDeleteModalOpen = false;
    public $periodoToDelete = null;

    public function mount()
    {
        $this->periodos = Periodo::all();
        $this->cuestionarios = Cuestionario::all();
    }

    public function render()
    {
        return view('livewire.periodos.inicio');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->reset();
    }

    protected function rules()
    {
        $rules = [
            'cuestionario_id' => 'required|exists:cuestionarios,id',
            'descripcion' => 'nullable',
        ];

        // Solo validar la clave si es un nuevo período
        if (!$this->periodo_id) {
            $rules['clave'] = [
                'required',
                'min:3',
                'unique:periodos,clave',
            ];
        } else {
            // Si estamos actualizando, solo validar la clave si ha cambiado
            $rules['clave'] = [
                'required',
                'min:3',
                'unique:periodos,clave,' . $this->periodo_id,
            ];
        }

        return $rules;
    }

    public function store()
    {
        try {
            $this->validate($this->rules());

            $data = [
                'cuestionario_id' => $this->cuestionario_id,
                'descripcion' => $this->descripcion,
                'clave' => $this->clave,
            ];

            Periodo::updateOrCreate(['id' => $this->periodo_id], $data);

            session()->flash('message', $this->periodo_id ? 'Período actualizado.' : 'Período creado.');
            $this->closeModalPopover();
            $this->resetCreateForm();
        } catch (\Exception $e) {
            \Log::error('Error al guardar período: ' . $e->getMessage(), [
                'periodo_id' => $this->periodo_id,
                'clave' => $this->clave,
                'descripcion' => $this->descripcion,
                'cuestionario_id' => $this->cuestionario_id
            ]);
            session()->flash('error', 'Error al guardar el período: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $periodo = Periodo::findOrFail($id);
        $this->periodo_id = $id;
        $this->cuestionario_id = $periodo->cuestionario_id;
        $this->clave = $periodo->clave;
        $this->descripcion = $periodo->descripcion;
        $this->periodo_id = $id; // Asegurarnos de que periodo_id está establecido

        $this->openModalPopover();
    }

    public function confirmDelete($id)
    {
        try {
            $this->periodoToDelete = Periodo::findOrFail($id);
            $this->isDeleteModalOpen = true;
        } catch (\Exception $e) {
            session()->flash('error', 'Error al cargar el período: ' . $e->getMessage());
        }
    }

    public function cancelDelete()
    {
        $this->isDeleteModalOpen = false;
        $this->periodoToDelete = null;
    }

    public function delete($id)
    {
        try {
            $periodo = Periodo::findOrFail($id);
            
            // Verificar si el período está en uso
            if ($periodo->estaEnUso()) {
                session()->flash('error', 'Este período no puede ser eliminado porque tiene evaluaciones asociadas.');
                $this->isDeleteModalOpen = false;
                $this->periodoToDelete = null;
                return;
            }

            $periodo->delete();
            session()->flash('message', 'Período eliminado correctamente.');
            $this->isDeleteModalOpen = false;
            $this->periodoToDelete = null;
            $this->periodos = Periodo::all(); // Actualizar la lista de períodos
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar el período: ' . $e->getMessage());
            $this->isDeleteModalOpen = false;
            $this->periodoToDelete = null;
        }
    }
}
