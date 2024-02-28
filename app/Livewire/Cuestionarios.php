<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cuestionario;

class Cuestionarios extends Component
{
    public $cuestionarios;
    public $titulo, $descripcion, $version, $cuestionario_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->cuestionarios = Cuestionario::all();
        return view('livewire.cuestionarios.inicio');
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
        $this->validate([
            'titulo' => 'required',
            'version' => 'required',
        ]);

        Cuestionario::updateOrCreate(['id' => $this->cuestionario_id], [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'version' => $this->version,
        ]);

        session()->flash('message', $this->cuestionario_id ? 'Cuestionario actualizada.' : 'Cuestionario creada.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $cuestionario = Cuestionario::findOrFail($id);
        $this->cuestionario_id = $id;
        $this->titulo = $cuestionario->titulo;
        $this->descripcion = $cuestionario->descripcion;
        $this->version = $cuestionario->version;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        Cuestionario::find($id)->delete();
        session()->flash('message', 'Cuestionario borrada.');
    }
}
