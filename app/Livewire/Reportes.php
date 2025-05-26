<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Alumno;
use App\Models\Inscripcion;
use App\Models\Grupo;
use App\Models\Cuestionario;
use App\Models\Rubro;

class Reportes extends Component
{
    use WithPagination;
    public $totalAlumnos = 0;
    public $completaron = 0;
    public $noCompletaron = 0;
    public $porcentajeCompletaron = 0;

    public function mount()
    {
        // Ejemplo: datos globales de inscripciones
        $this->totalAlumnos = Alumno::count();
        $this->completaron = Inscripcion::where('estado', 1)->distinct('alumno_id')->count('alumno_id');
        $this->noCompletaron = $this->totalAlumnos - $this->completaron;
        $this->porcentajeCompletaron = $this->totalAlumnos > 0 ? round(($this->completaron / $this->totalAlumnos) * 100, 2) : 0;
        // Aquí puedes agregar más cálculos para plantel, semestre, rubros, etc.
    }

    public function render()
    {
        return view('livewire.reportes', [
            'totalAlumnos' => $this->totalAlumnos,
            'completaron' => $this->completaron,
            'noCompletaron' => $this->noCompletaron,
            'porcentajeCompletaron' => $this->porcentajeCompletaron,
        ])->extends('layouts.app')->section('content');
    }
}
