<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Pregunta;
use App\Models\Rubro;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Preguntas extends Component
{
    use WithPagination;

    #[Validate('required|min:3')]
    public $titulo;

    #[Validate('required|exists:rubros,id', as: 'rubro')]
    public $rubro_id;

    #[Validate([
        'respuestas' => 'required|array|min:1',
        'respuestas.*.respuesta' => 'required|min:5',
        'respuestas.*.orden' => 'required|integer|min:1',
        'respuestas.*.puntos' => 'required|numeric|min:0',
    ], message: [
        'respuestas.required' => 'Debe agregar al menos una respuesta.',
        'respuestas.*.respuesta.required' => 'La respuesta es requerida.',
        'respuestas.*.respuesta.min' => 'La respuesta debe tener al menos 5 caracteres.',
        'respuestas.*.orden.required' => 'El orden es requerido.',
        'respuestas.*.orden.min' => 'El orden debe ser mayor a 0.',
        'respuestas.*.puntos.required' => 'Los puntos son requeridos.',
        'respuestas.*.puntos.min' => 'Los puntos deben ser mayores o iguales a 0.',
    ], attribute: [
        'respuestas.*.respuesta' => 'respuesta',
        'respuestas.*.orden' => 'orden',
        'respuestas.*.puntos' => 'puntos',
    ])]
    public $respuestas = [];

    public $version;
    public $pregunta_id;
    public $isModalOpen = 0;
    public $cuestionario_id = 0;
    public $rubros;
    public $numpreguntas = 10;


    public function mount($cuestionario_id = 0)
    {
        $this->rubros = Rubro::all();
        $this->cuestionario_id = $cuestionario_id;
        $this->respuestas = [['respuesta' => '', 'orden' => 1, 'puntos' => 1]];
    }

    #[On('cuestionario_id')]
    public function obtieneCuestionario($idcuestionario)
    {
        $this->cuestionario_id = $idcuestionario;
    }

    public function create()
    {
        $this->openModalPopover();
    }

    public function numeroPaginas($numero){
        $this->numpreguntas = $numero;
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
        $this->reset('titulo', 'rubro_id', 'pregunta_id');
        $this->respuestas = [['respuesta' => '', 'orden' => 1, 'puntos' => 1]];
    }

    public function agregarRespuesta()
    {
        $this->respuestas[] = [
            'respuesta' => '',
            'orden' => count($this->respuestas) + 1,
            'puntos' => 1
        ];
    }

    public function eliminarRespuesta($index)
    {
        unset($this->respuestas[$index]);
        $this->respuestas = array_values($this->respuestas);
        
        // Reordenar las respuestas restantes
        foreach ($this->respuestas as $key => $respuesta) {
            $this->respuestas[$key]['orden'] = $key + 1;
        }
    }

    protected function validateOrdenesUnicos()
    {
        $ordenes = collect($this->respuestas)->pluck('orden')->toArray();
        $ordenesUnicos = array_unique($ordenes);
        
        if (count($ordenes) !== count($ordenesUnicos)) {
            $duplicados = array_diff_assoc($ordenes, array_unique($ordenes));
            $this->addError('respuestas', 'Hay respuestas con el mismo orden: ' . implode(', ', $duplicados));
            return false;
        }
        return true;
    }

    public function store()
    {
        $this->validate();

        if (!$this->validateOrdenesUnicos()) {
            return;
        }

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
                'respuesta' => $respuesta['respuesta'],
                'orden' => $respuesta['orden'],
                'puntos' => $respuesta['puntos']
            ]);
        }

        session()->flash('message', $this->pregunta_id ? 'Pregunta actualizada.' : 'Pregunta creada.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'respuestas.') && str_ends_with($propertyName, '.orden')) {
            $this->validateOrdenesUnicos();
        }
    }

    public function edit($id)
    {
        $pregunta = Pregunta::findOrFail($id);
        $this->pregunta_id = $id;
        $this->cuestionario_id = $pregunta->cuestionario_id;
        $this->rubro_id = $pregunta->rubro_id;
        $this->titulo = $pregunta->titulo;
        
        $this->respuestas = $pregunta->respuestas->map(function($respuesta) {
            return [
                'respuesta' => $respuesta->respuesta,
                'orden' => $respuesta->orden,
                'puntos' => $respuesta->puntos
            ];
        })->toArray();

        $this->openModalPopover();
    }

    public function delete($id)
    {
        Pregunta::find($id)->delete();
        session()->flash('message', 'Pregunta borrada.');
    }


    public function render()
    {
        return view('livewire.preguntas.inicio', [
            'preguntas' => Pregunta::where('cuestionario_id', $this->cuestionario_id)->paginate($this->numpreguntas),
        ]);
    }
}
