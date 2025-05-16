<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Pregunta;
use App\Models\Rubro;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

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
    public $preguntas;
    public $descripcion;
    public $isDeleteModalOpen = false;
    public $preguntaToDelete = null;

    protected $rules = [
        'titulo' => 'required|min:3',
        'rubro_id' => 'required|exists:rubros,id',
        'respuestas' => 'required|array|min:1',
        'respuestas.*.texto' => 'required|min:1',
        'respuestas.*.orden' => 'required|integer|min:1',
    ];

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

        try {
            DB::beginTransaction();

            // Verificar que no haya órdenes duplicados
            $ordenes = collect($this->respuestas)->pluck('orden');
            if ($ordenes->duplicates()->isNotEmpty()) {
                throw new \Exception('No puede haber órdenes duplicados en las respuestas.');
            }

            if ($this->pregunta_id) {
                // Actualizar pregunta existente
                $pregunta = Pregunta::findOrFail($this->pregunta_id);
                $pregunta->update([
                    'titulo' => $this->titulo,
                    'rubro_id' => $this->rubro_id,
                ]);
            } else {
                // Crear nueva pregunta
                $pregunta = Pregunta::create([
                    'titulo' => $this->titulo,
                    'rubro_id' => $this->rubro_id,
                    'cuestionario_id' => $this->cuestionario_id,
                ]);
            }

            if ($this->pregunta_id) {
                // Obtener respuestas actuales
                $respuestasActuales = $pregunta->respuestas()->get();
                $respuestasNuevas = collect($this->respuestas);
                
                // Preparar arrays para actualización
                $idsAMantener = [];

                // Primero procesamos las respuestas existentes
                foreach ($respuestasNuevas as $respuesta) {
                    if (isset($respuesta['id'])) {
                        // Es una respuesta existente
                        $respuestaExistente = $respuestasActuales->firstWhere('id', $respuesta['id']);
                        
                        if ($respuestaExistente) {
                            if ($respuestaExistente->estaEnUso()) {
                                // Si está en uso, solo actualizamos orden y puntos
                                $respuestaExistente->update([
                                    'orden' => $respuesta['orden'],
                                    'puntos' => $respuesta['puntos']
                                ]);
                            } else {
                                // Si no está en uso, actualizamos todo
                                $respuestaExistente->update([
                                    'respuesta' => $respuesta['respuesta'],
                                    'orden' => $respuesta['orden'],
                                    'puntos' => $respuesta['puntos']
                                ]);
                            }
                            $idsAMantener[] = $respuestaExistente->id;
                        }
                    }
                }

                // Luego procesamos las nuevas respuestas
                foreach ($respuestasNuevas as $respuesta) {
                    if (!isset($respuesta['id'])) {
                        // Es una nueva respuesta
                        $nuevaRespuesta = $pregunta->respuestas()->create([
                            'respuesta' => $respuesta['respuesta'],
                            'orden' => $respuesta['orden'],
                            'puntos' => $respuesta['puntos']
                        ]);
                        $idsAMantener[] = $nuevaRespuesta->id;
                    }
                }

                // Eliminar respuestas que ya no existen y no están en uso
                $pregunta->respuestas()
                    ->whereNotIn('id', $idsAMantener)
                    ->whereDoesntHave('resultados')
                    ->delete();

            } else {
                // Para nuevas preguntas, crear todas las respuestas
                foreach ($this->respuestas as $respuesta) {
                    $pregunta->respuestas()->create([
                        'respuesta' => $respuesta['respuesta'],
                        'orden' => $respuesta['orden'],
                        'puntos' => $respuesta['puntos']
                    ]);
                }
            }

            DB::commit();
            session()->flash('message', $this->pregunta_id ? 'Pregunta actualizada.' : 'Pregunta creada.');
            $this->closeModalPopover();
            $this->resetCreateForm();

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al guardar pregunta: ' . $e->getMessage(), [
                'pregunta_id' => $this->pregunta_id,
                'respuestas' => $this->respuestas,
                'error' => $e->getMessage()
            ]);
            session()->flash('error', 'Error al guardar la pregunta: ' . $e->getMessage());
        }
    }

    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'respuestas.') && str_ends_with($propertyName, '.orden')) {
            $this->validateOrdenesUnicos();
        }
    }

    public function edit($id)
    {
        $pregunta = Pregunta::with(['respuestas' => function($query) {
            $query->orderBy('orden');
        }])->findOrFail($id);
        
        $this->pregunta_id = $id;
        $this->cuestionario_id = $pregunta->cuestionario_id;
        $this->rubro_id = $pregunta->rubro_id;
        $this->titulo = $pregunta->titulo;
        
        // Depurar los datos de las respuestas
        $respuestasArray = [];
        foreach ($pregunta->respuestas as $respuesta) {
            $respuestasArray[] = [
                'id' => $respuesta->id,
                'respuesta' => trim($respuesta->respuesta), // Asegurar que no hay espacios extra
                'orden' => (int)$respuesta->orden,
                'puntos' => (float)$respuesta->puntos,
                'en_uso' => $respuesta->estaEnUso()
            ];
        }
        
        $this->respuestas = $respuestasArray;
        
        // Depurar los datos cargados
        \Log::info('Respuestas cargadas:', ['respuestas' => $this->respuestas]);
        
        $this->openModalPopover();
    }

    public function confirmDelete($id)
    {
        $this->preguntaToDelete = Pregunta::findOrFail($id);
        $this->isDeleteModalOpen = true;
    }

    public function cancelDelete()
    {
        $this->isDeleteModalOpen = false;
        $this->preguntaToDelete = null;
    }

    public function delete($id)
    {
        $pregunta = Pregunta::findOrFail($id);
        
        // Verificar si la pregunta está en uso
        if ($pregunta->estaEnUso()) {
            session()->flash('error', 'Esta pregunta no puede ser eliminada porque está siendo utilizada en evaluaciones.');
            $this->isDeleteModalOpen = false;
            $this->preguntaToDelete = null;
            return;
        }

        $pregunta->delete();
        session()->flash('message', 'Pregunta eliminada correctamente.');
        $this->isDeleteModalOpen = false;
        $this->preguntaToDelete = null;
    }

    public function render()
    {
        return view('livewire.preguntas.inicio', [
            'preguntas' => Pregunta::where('cuestionario_id', $this->cuestionario_id)->paginate($this->numpreguntas),
        ]);
    }
}
