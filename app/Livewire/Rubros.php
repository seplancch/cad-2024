<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Rubro;

class Rubros extends Component
{
    public $rubros;

    #[Validate('required|min:3|max:255')]
    public $titulo;

    #[Validate('required|min:3')]
    public $descripcion;

    public $version;
    public $rubro_id;
    public $isModalOpen = 0;
    public $isDeleteModalOpen = false;
    public $rubroToDelete = null;

    public function render()
    {
        $this->rubros = Rubro::all();
        return view('livewire.rubros.inicio');
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

        Rubro::updateOrCreate(['id' => $this->rubro_id], [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('message', $this->rubro_id ? 'Rubro actualizada.' : 'Rubro creada.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $rubro = Rubro::findOrFail($id);
        $this->rubro_id = $id;
        $this->titulo = $rubro->titulo;
        $this->descripcion = $rubro->descripcion;


        $this->openModalPopover();
    }

    public function confirmDelete($id)
    {
        $this->rubroToDelete = Rubro::findOrFail($id);
        $this->isDeleteModalOpen = true;
    }

    public function cancelDelete()
    {
        $this->isDeleteModalOpen = false;
        $this->rubroToDelete = null;
    }

    public function delete($id)
    {
        $rubro = Rubro::findOrFail($id);
        
        // Verificar si el rubro está en uso
        if ($rubro->preguntas()->exists()) {
            session()->flash('error', 'Este rubro no puede ser eliminado porque tiene preguntas asociadas.');
            $this->isDeleteModalOpen = false;
            $this->rubroToDelete = null;
            return;
        }

        $rubro->delete();
        session()->flash('message', 'Rubro eliminado correctamente.');
        $this->isDeleteModalOpen = false;
        $this->rubroToDelete = null;
    }
}
