<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Cuestionario;

class Cuestionarios extends Component
{

    #[Validate('required|min:3|max:255')]
    public $titulo;

    #[Validate('required|min:3')]
    public $version;

    public $cuestionarios;
    public $descripcion;
    public $cuestionario_id;
    public $isModalOpen = 0;
    public $isDeleteModalOpen = false;
    public $cuestionarioToDelete = null;

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
        $this->validate();

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

    public function confirmDelete($id)
    {
        $this->cuestionarioToDelete = Cuestionario::findOrFail($id);
        $this->isDeleteModalOpen = true;
    }

    public function cancelDelete()
    {
        $this->isDeleteModalOpen = false;
        $this->cuestionarioToDelete = null;
    }

    public function delete($id)
    {
        $cuestionario = Cuestionario::findOrFail($id);
        
        // Verificar si el cuestionario está en uso
        if ($cuestionario->estaEnUso()) {
            if ($cuestionario->periodos()->exists()) {
                session()->flash('error', 'Este cuestionario no puede ser eliminado porque está siendo utilizado en períodos activos.');
            } else {
                session()->flash('error', 'Este cuestionario no puede ser eliminado porque tiene preguntas que están siendo utilizadas en evaluaciones.');
            }
            $this->isDeleteModalOpen = false;
            $this->cuestionarioToDelete = null;
            return;
        }

        $cuestionario->delete();
        session()->flash('message', 'Cuestionario borrado.');
        $this->isDeleteModalOpen = false;
        $this->cuestionarioToDelete = null;
    }

    public function view($id){
        redirect()->to('/cuestionarios/'.$id);
    }
}
