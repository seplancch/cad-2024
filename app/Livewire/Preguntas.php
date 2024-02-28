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
    public $encuesta_id;
    public $rubros;
    public $rubro_id;


    public function mount(Request $request)
    {
        $this->encuesta_id = $request->route('id');
    }

    public function render()
    {
        //$this->preguntas = Pregunta::find($this->encuesta_id)->preguntas;
        //$this->preguntas = Pregunta->encuesta;
        $this->preguntas = Pregunta::where('encuesta_id', $this->encuesta_id)->get();
        $this->rubros = Rubro::all();

        //$this->encuesta_id = (string) $this->encuesta_id;
        return view('livewire.preguntas.inicio');
    }

    public function create()
    {

        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->resetCreateForm();
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
            'encuesta_id' => $this->encuesta_id,
            'rubro_id' => $this->rubro_id,
            'titulo'   => $this->titulo,
            'opcion_1' => $this->opcion_1,
            'opcion_2' => $this->opcion_2,
            'opcion_3' => $this->opcion_3,
            'correct_answer_no' => '1',
        ]);

        session()->flash('message', $this->pregunta_id ? 'Pregunta actualizada.' : 'Pregunta creada.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $pregunta = Pregunta::findOrFail($id);
        $this->pregunta_id = $id;
        $this->encuesta_id = $pregunta->encuesta_id;
        $this->rubro_id = $pregunta->rubro_id;
        $this->titulo = $pregunta->titulo;
        $this->opcion_1 = $pregunta->opcion_1;
        $this->opcion_2 = $pregunta->opcion_2;
        $this->opcion_3 = $pregunta->opcion_3;
        $this->correct_answer_no = $pregunta->correct_answer_no;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        Pregunta::find($id)->delete();
        session()->flash('message', 'Pregunta borrada.');
    }
}
