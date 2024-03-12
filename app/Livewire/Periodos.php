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
    public $isModalOpen = 0;

    public function render()
    {
        $this->periodos = Periodo::all();
        $this->cuestionarios = Cuestionario::all();
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

    public function store()
    {
        $this->validate();

        Periodo::updateOrCreate(['id' => $this->periodo_id], [
            'cuestionario_id' => $this->cuestionario_id, // 'cuestionario_id' => 'required|exists:cuestionarios,id
            'clave' => $this->clave,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('message', $this->periodo_id ? 'Periodo actualizado.' : 'Periodo creado.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $periodo = Periodo::findOrFail($id);
        $this->cuestionario_id = $periodo->cuestionario_id;
        $this->clave = $periodo->clave;
        $this->descripcion = $periodo->descripcion;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        Periodo::find($id)->delete();
        session()->flash('message', 'Periodo borrado.');
    }
}
