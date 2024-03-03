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
    public $respuestas = [''];
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

    private function resetCreateForm()
    {
        $this->reset('titulo', 'respuestas', 'rubro_id');
    }

    public function agregarRespuesta()
    {
        $this->respuestas[] = '';
    }

    public function eliminarRespuesta($index)
    {
        unset($this->respuestas[$index]);
    }

    public function store()
    {
        $this->validate([
            'titulo' => 'required|string|min:6|max:255',
            'rubro_id' => 'required|numeric',
            'respuestas.*' => 'required | min:1 | max:255 | string'
        ], [
            'titulo.required' => 'El título es requerido.',
            'titulo.min' => 'El título debe tener al menos 6 caracteres.',
            'titulo.max' => 'El título no debe tener más de 255 caracteres.',
            'rubro_id.required' => 'El rubro es requerido.',
            'rubro_id.numeric' => 'El rubro debe ser un número.',
            'respuestas.*.required' => 'La respuesta es requerida.',
            'respuestas.*.min' => 'La respuesta debe tener al menos 1 caracter.',
            'respuestas.*.max' => 'La respuesta no debe tener más de 255 caracteres.',
            'respuestas.*.string' => 'La respuesta debe ser un texto.'
        ]);

        $pregunta = Pregunta::updateOrCreate([
            'id' => $this->pregunta_id
        ], [
            'cuestionario_id' => $this->cuestionario_id,
            'rubro_id' => $this->rubro_id,
            'titulo'   => $this->titulo,
        ]);

        $pregunta->respuestas()->delete();

        foreach ($this->respuestas as $respuesta) {
            $pregunta->respuestas()->create([
                'pregunta_id' => $pregunta->id,
                'respuesta' => $respuesta,
                'orden' => '1',
                'puntos' => '1'
            ]);
        }

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
        $this->respuestas = $pregunta->respuestas->pluck('respuesta')->toArray();


        $this->openModalPopover();
    }

    public function delete($id)
    {
        Pregunta::find($id)->delete();
        session()->flash('message', 'Pregunta borrada.');
    }
}
