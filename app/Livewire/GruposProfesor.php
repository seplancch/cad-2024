<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;
use function App\Helpers\obtieneIdPeriodoActual;
use App\Models\Rubro;
use App\Models\Resultado;
use function App\Helpers\convertLikertTo1To10;

/**
 * Componente Livewire para gestionar los grupos asignados a un profesor.
 */
class GruposProfesor extends Component
{
    /** @var string Campo por el cual ordenar */
    public $sortField = 'id';

    /** @var string Dirección de ordenamiento */
    public $sortDirection = 'asc';

    /** @var int ID del periodo actual */
    public $periodoId;

    /**
     * Inicializa el componente.
     *
     * @return void
     */
    public function mount()
    {
        $this->periodoId = obtieneIdPeriodoActual();
    }

    /**
     * Renderiza la vista del componente.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $profesor = Auth::user()->profesor;
        $grupos = Grupo::with(['asignatura', 'plantel', 'periodo'])
            ->where('profesor_id', $profesor->id)
            ->where('periodo_id', $this->periodoId)
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        foreach ($grupos as $grupo) {
            $suma = 0;
            $cuenta = 0;
            $rubros = Rubro::with('preguntas')->get();
            foreach ($rubros as $rubro) {
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

                    $prom = $query
                        ->pluck('respuestas.puntos')
                        ->map(
                            function ($punto) {
                                return convertLikertTo1To10($punto);
                            }
                        )
                        ->avg();

                    if ($prom !== null) {
                        $suma += $prom;
                        $cuenta++;
                    }
                }
            }
            $grupo->promedio_general = $cuenta > 0
                ? number_format($suma / $cuenta, 2)
                : '-';
        }

        return view(
            'livewire.profesores.grupos-profesor',
            [
                'grupos' => $grupos
            ]
        );
    }

    /**
     * Cambia el campo por el cual ordenar.
     *
     * @param string $field Campo a ordenar
     *
     * @return void
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
}
