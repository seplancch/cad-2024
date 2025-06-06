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
use function App\Helpers\convertLikertTo1To10;

class PromediosGruposProfesor extends Component
{
    public $periodo_id;
    public $grupos;
    public $rubros;
    public $promedios = [];
    public $grupoSeleccionado = '';
    public $grupoId;

    protected $listeners = ['grupoSeleccionado' => 'setGrupoSeleccionado'];

    public function mount($grupoId = null)
    {
        $this->grupoId = $grupoId;
        Log::info('PromediosGruposProfesor: mount() llamado.', ['grupoId' => $grupoId]);
        $this->periodo_id = obtieneIdPeriodoActual();
        $profesor = Auth::user()->profesor;
        $this->grupos = Grupo::where('profesor_id', $profesor->id)
            ->where('periodo_id', $this->periodo_id)
            ->get();
        $this->rubros = Rubro::with('preguntas')->get();
        $this->calcularPromedios();
        Log::info('PromediosGruposProfesor: mount() completado.', ['initial_grupoSeleccionado' => $this->grupoSeleccionado]);
    }

    public function updatedGrupoSeleccionado()
    {
        // No es necesario recalcular promedios aquí si setGrupoSeleccionado lo maneja
        // y el render se encarga de la lógica de visualización.
        // Log::info('PromediosGruposProfesor: updatedGrupoSeleccionado HOOK.', ['valor' => $this->grupoSeleccionado]);
    }

    public function calcularPromedios()
    {
        foreach ($this->grupos as $grupo) {
            foreach ($this->rubros as $rubro) {
                foreach ($rubro->preguntas as $pregunta) {
                    $query = Resultado::whereHas(
                        'inscripcion',
                        function ($q) use ($grupo) {
                            $q->where('grupo_id', $grupo->id);
                        }
                    )
                    ->where('resultados.pregunta_id', $pregunta->id)
                    ->join(
                        'respuestas',
                        'resultados.respuesta_id',
                        '=',
                        'respuestas.id'
                    );

                    $promedio = $query->pluck('respuestas.puntos')->map(
                        function ($punto) {
                            return convertLikertTo1To10($punto);
                        }
                    )->avg();

                    $this->promedios[$grupo->id][$rubro->id][$pregunta->id] = $promedio;
                }
            }
        }
    }

    public function setGrupoSeleccionado($grupoId)
    {
        Log::info('PromediosGruposProfesor: setGrupoSeleccionado ANTES.', ['current_grupoSeleccionado' => $this->grupoSeleccionado, 'new_grupoId_received' => $grupoId]);
        $this->grupoSeleccionado = $grupoId;
        Log::info('PromediosGruposProfesor: setGrupoSeleccionado DESPUÉS.', ['updated_grupoSeleccionado' => $this->grupoSeleccionado]);
    }

    public function render()
    {
        Log::info('PromediosGruposProfesor: render() llamado.', ['grupoId' => $this->grupoId]);
        $gruposMostrar = collect();
        if ($this->grupoId) {
            $grupoId = (int)$this->grupoId;
            $gruposMostrar = $this->grupos->filter(function ($g) use ($grupoId) {
                return $g->id === $grupoId;
            })->values();
        }

        Log::info('PromediosGruposProfesor: render() - gruposMostrar count.', ['count' => $gruposMostrar->count(), 'ids' => $gruposMostrar->pluck('id')->all()]);
        Log::info('PromediosGruposProfesor: render() - gruposMostrar contenido.', ['gruposMostrar' => $gruposMostrar->toArray()]);
        return view('livewire.profesores.promedios-grupos-profesor', [
            'grupos' => $gruposMostrar,
            'rubros' => $this->rubros,
            'promedios' => $this->promedios,
        ]);
    }
}
