<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Grupo;
use App\Models\Rubro;
use App\Models\Pregunta;
use App\Models\Resultado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function App\Helpers\obtieneIdPeriodoActual;

class PromediosGruposProfesor extends Component
{
    public $periodo_id;
    public $grupos;
    public $rubros;
    public $promedios = [];
    public $grupoSeleccionado = '';

    protected $listeners = ['grupoSeleccionado' => 'setGrupoSeleccionado'];

    public function mount()
    {
        $this->periodo_id = obtieneIdPeriodoActual();
        $profesor = Auth::user()->profesor;
        $this->grupos = Grupo::where('profesor_id', $profesor->id)
            ->where('periodo_id', $this->periodo_id)
            ->get();
        $this->rubros = Rubro::with('preguntas')->get();
        $this->calcularPromedios();
    }

    public function updatedGrupoSeleccionado()
    {
        // No es necesario recalcular promedios, solo cambia la vista
    }

    public function calcularPromedios()
    {
        foreach ($this->grupos as $grupo) {
            foreach ($this->rubros as $rubro) {
                foreach ($rubro->preguntas as $pregunta) {
                    $query = Resultado::whereHas('inscripcion', function($q) use ($grupo) {
                        $q->where('grupo_id', $grupo->id);
                    })
                    ->where('resultados.pregunta_id', $pregunta->id)
                    ->join('respuestas', 'resultados.respuesta_id', '=', 'respuestas.id');

                    $promedio = $query->avg('respuestas.puntos');
                    $this->promedios[$grupo->id][$rubro->id][$pregunta->id] = $promedio;
                }
            }
        }
    }

    public function setGrupoSeleccionado($grupoId)
    {
        $this->grupoSeleccionado = $grupoId;
    }

    public function render()
    {
        Log::info('grupoSeleccionado', ['valor' => $this->grupoSeleccionado]);
        $gruposMostrar = collect();
        if ($this->grupoSeleccionado === 'all') {
            $gruposMostrar = $this->grupos;
        } elseif ($this->grupoSeleccionado) {
            $grupoId = (int)$this->grupoSeleccionado;
            $gruposMostrar = $this->grupos->filter(function ($g) use ($grupoId) {
                return (string)$g->id === (string)$grupoId;
            })->values();
        }
        Log::info('gruposMostrar', ['ids' => $gruposMostrar->pluck('id')->all()]);
        return view('livewire.profesores.promedios-grupos-profesor', [
            'grupos' => $gruposMostrar,
            'rubros' => $this->rubros,
            'promedios' => $this->promedios,
            'grupoSeleccionado' => $this->grupoSeleccionado,
            'gruposSelector' => $this->grupos,
        ]);
    }
}
