<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Pregunta;
use App\Models\Rubro;

class Preguntas extends Component
{
    public $preguntas;
    public $titulo;
    public $opcion_1, $opcion_2, $opcion_3, $opcion_4, $opcion_5;
    public $version;
    public $pregunta_id;
    public $isModalOpen = 0;
    public $cuestionario_id;
    public $rubros;
    public $rubro_id;


    public function mount(Request $request)
    {
        $this->cuestionario_id = $request->route('id');
    }

    public function render()
    {
        $this->preguntas = Pregunta::where('cuestionario_id', $this->cuestionario_id)->get();
        $this->rubros = Rubro::all();

        return view('livewire.preguntas.inicio');
    }

    public function create()
    {

        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
        $this->resetCreateForm();
    }

    private function resetCreateForm(){
        $this->reset('titulo', 'opcion_1', 'opcion_2', 'opcion_3', 'opcion_4', 'opcion_5', 'rubro_id');
    }

    public function store()
    {
        $this->validate([
            'titulo' => 'required',
            'opcion_1' => 'required',
            'opcion_2' => 'required',
            'opcion_3' => 'required',
            'rubro_id' => 'required',
        ]);

        Pregunta::updateOrCreate(['id' => $this->pregunta_id], [
            'cuestionario_id' => $this->cuestionario_id,
            'rubro_id' => $this->rubro_id,
            'titulo'   => $this->titulo,
            'opcion_1' => $this->opcion_1,
            'opcion_2' => $this->opcion_2,
            'opcion_3' => $this->opcion_3,
            'opcion_4' => $this->opcion_4,
            'opcion_5' => $this->opcion_5,
        ]);

        session()->flash('message', $this->pregunta_id ? 'Pregunta actualizada.' : 'Pregunta creada.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $pregunta = Pregunta::findOrFail($id);
        $this->pregunta_id = $id;
        $this->cuestionario_id = $pregunta->cuestionario_id;
        $this->rubro_id = $pregunta->rubro_id;
        $this->titulo = $pregunta->titulo;
        $this->opcion_1 = $pregunta->opcion_1;
        $this->opcion_2 = $pregunta->opcion_2;
        $this->opcion_3 = $pregunta->opcion_3;
        $this->opcion_4 = $pregunta->opcion_4;
        $this->opcion_5 = $pregunta->opcion_5;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        Pregunta::find($id)->delete();
        session()->flash('message', 'Pregunta borrada.');
    }
}
