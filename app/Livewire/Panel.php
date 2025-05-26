<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Periodo;
use App\Models\Configuracion;

class Panel extends Component
{
    public $periodoSeleccionado;
    public $periodoActual;
    public $periodos;

    public function mount()
    {
        $this->periodos = Periodo::orderBy('clave', 'desc')->get();

        // Obtener la configuración del periodo actual
        $configuracion = Configuracion::where('nombre', 'PERIODO_ACTUAL')->first();

        // Si no hay configuración o no hay periodo configurado
        if (!$configuracion) {
            // Si hay periodos disponibles, usar el primero
            if ($this->periodos->isNotEmpty()) {
                $this->periodoActual = $this->periodos->first();
                $this->periodoSeleccionado = $this->periodoActual->id;

                // Crear la configuración
                Configuracion::create([
                    'nombre' => 'PERIODO_ACTUAL',
                    'valor' => $this->periodoActual->id,
                    'tipo' => 'periodo',
                    'descripcion' => 'Periodo actual del sistema'
                ]);
            }
        } else {
            $this->periodoActual = Periodo::find($configuracion->valor);
            $this->periodoSeleccionado = $this->periodoActual ? $this->periodoActual->id : null;
        }
    }

    public function cambiarPeriodo()
    {
        // Revisar fechas activas para ambos semestres
        $inicio6 = Configuracion::where('nombre', 'INICIO_6')->first();
        $cierre6 = Configuracion::where('nombre', 'CIERRE_6')->first();
        $inicio24 = Configuracion::where('nombre', 'INICIO_24')->first();
        $cierre24 = Configuracion::where('nombre', 'CIERRE_24')->first();

        $fechaActual = now();
        $activo6 = false;
        $activo24 = false;

        if ($inicio6 && $cierre6) {
            $fechaInicio6 = \Carbon\Carbon::createFromFormat('d-m-Y', $inicio6->valor);
            $fechaCierre6 = \Carbon\Carbon::createFromFormat('d-m-Y', $cierre6->valor)->setTime(23, 59, 59);
            $activo6 = $fechaActual->between($fechaInicio6, $fechaCierre6);
        }
        if ($inicio24 && $cierre24) {
            $fechaInicio24 = \Carbon\Carbon::createFromFormat('d-m-Y', $inicio24->valor);
            $fechaCierre24 = \Carbon\Carbon::createFromFormat('d-m-Y', $cierre24->valor)->setTime(23, 59, 59);
            $activo24 = $fechaActual->between($fechaInicio24, $fechaCierre24);
        }

        if ($activo6 || $activo24) {
            session()->flash('error', 'No es posible modificar el periodo actual porque existen procesos activos del CAD. Espere a que concluyan las fechas de inicio y cierre para realizar cambios en el periodo.');
            return;
        }

        $configuracion = Configuracion::where('nombre', 'PERIODO_ACTUAL')->first();
        if (!$configuracion) {
            $configuracion = new Configuracion();
            $configuracion->nombre = 'PERIODO_ACTUAL';
            $configuracion->tipo = 'periodo';
            $configuracion->descripcion = 'Periodo actual del sistema';
        }

        $configuracion->valor = $this->periodoSeleccionado;
        $configuracion->save();

        $this->periodoActual = Periodo::find($this->periodoSeleccionado);

        session()->flash('message', 'El periodo actual se actualizó correctamente.');
    }

    public function render()
    {
        return view('livewire.panel');
    }
}
