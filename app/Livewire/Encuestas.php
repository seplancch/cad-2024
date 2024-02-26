<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Encuesta;

class Encuestas extends Component
{
    public $encuestas;
    public $titulo, $descripcion, $version, $encuesta_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->encuestas = Encuesta::all();
        return view('livewire.encuestas.inicio');
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

        Encuesta::updateOrCreate(['id' => $this->encuesta_id], [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'version' => $this->version,
        ]);

        session()->flash('message', $this->encuesta_id ? 'Encuesta actualizada.' : 'Encuesta creada.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $encuesta = Encuesta::findOrFail($id);
        $this->encuesta_id = $id;
        $this->titulo = $encuesta->titulo;
        $this->descripcion = $encuesta->descripcion;
        $this->version = $encuesta->version;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        Encuesta::find($id)->delete();
        session()->flash('message', 'Encuesta borrada.');
    }
}
