<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Plantel;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function App\Helpers\obtieneIdPeriodoActual;

class ContadorController extends Controller
{
    public function __construct()
    {
        // No se requiere autenticación para ver el contador
    }

    public function index(Request $request)
    {
        $periodoActual = obtieneIdPeriodoActual();
        $planteles = Plantel::all();
        $plantelSeleccionado = $request->get('plantel_id');
        $semestreSeleccionado = $request->get('semestre');

        // Consulta base para el contador
        $query = Inscripcion::where('inscripciones.periodo_id', $periodoActual)
            ->where('inscripciones.activa', 1)
            ->select(
                'planteles.id as plantel_id',
                'planteles.nombre as plantel_nombre',
                'semestres.numero_semestre',
                DB::raw('COUNT(DISTINCT inscripciones.alumno_id) as total_alumnos'),
                DB::raw('COUNT(DISTINCT CASE WHEN inscripciones.estado = 1 THEN inscripciones.alumno_id END) as alumnos_completados'),
                DB::raw('COUNT(DISTINCT CASE WHEN inscripciones.estado = 0 THEN inscripciones.alumno_id END) as alumnos_pendientes')
            )
            ->join('alumnos', 'inscripciones.alumno_id', '=', 'alumnos.id')
            ->join('planteles', 'alumnos.plantel_id', '=', 'planteles.id')
            ->join('semestres', function($join) use ($periodoActual) {
                $join->on('alumnos.id', '=', 'semestres.alumno_id')
                    ->where('semestres.periodo_id', '=', $periodoActual);
            })
            ->groupBy('planteles.id', 'planteles.nombre', 'semestres.numero_semestre');

        // Filtrar por plantel si se seleccionó uno
        if ($plantelSeleccionado) {
            $query->where('planteles.id', $plantelSeleccionado);
        }

        // Filtrar por semestre si se seleccionó uno
        if ($semestreSeleccionado) {
            $query->where('semestres.numero_semestre', $semestreSeleccionado);
        }

        $estadisticas = $query->get();

        // Obtener lista de semestres disponibles
        $semestres = Inscripcion::where('inscripciones.periodo_id', $periodoActual)
            ->where('inscripciones.activa', 1)
            ->join('alumnos', 'inscripciones.alumno_id', '=', 'alumnos.id')
            ->join('semestres', function($join) use ($periodoActual) {
                $join->on('alumnos.id', '=', 'semestres.alumno_id')
                    ->where('semestres.periodo_id', '=', $periodoActual);
            })
            ->select('semestres.numero_semestre')
            ->distinct()
            ->orderBy('semestres.numero_semestre')
            ->pluck('numero_semestre');

        return view('contador.index', compact(
            'planteles',
            'plantelSeleccionado',
            'semestres',
            'semestreSeleccionado',
            'estadisticas'
        ));
    }
} 