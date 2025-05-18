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
        
        session()->flash('message', 'Periodo actualizado correctamente.');
    }

    public function render()
    {
        return view('livewire.panel');
    }
} 