<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Plantel;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function App\Helpers\obtieneIdPeriodoActual;

class EstadisticasController extends Controller
{
    public function index(Request $request)
    {
        $periodoActual = obtieneIdPeriodoActual();
        $planteles = Plantel::all();
        $plantelSeleccionado = $request->get('plantel_id');

        // Consulta base para estadísticas
        $query = Inscripcion::where('periodo_id', $periodoActual)
            ->where('activa', 1)
            ->select(
                'planteles.id as plantel_id',
                'planteles.nombre as plantel_nombre',
                DB::raw('COUNT(DISTINCT inscripciones.alumno_id) as total_alumnos'),
                DB::raw('COUNT(DISTINCT CASE WHEN inscripciones.estado = 1 THEN inscripciones.alumno_id END) as alumnos_completados'),
                DB::raw('COUNT(DISTINCT CASE WHEN inscripciones.estado = 0 THEN inscripciones.alumno_id END) as alumnos_pendientes')
            )
            ->join('alumnos', 'inscripciones.alumno_id', '=', 'alumnos.id')
            ->join('planteles', 'alumnos.plantel_id', '=', 'planteles.id')
            ->groupBy('planteles.id', 'planteles.nombre');

        // Filtrar por plantel si se seleccionó uno
        if ($plantelSeleccionado) {
            $query->where('planteles.id', $plantelSeleccionado);
        }

        $estadisticas = $query->get();

        // Estadísticas por semestre
        $estadisticasSemestre = Inscripcion::where('inscripciones.periodo_id', $periodoActual)
            ->where('activa', 1)
            ->select(
                'semestres.numero_semestre',
                DB::raw('COUNT(DISTINCT inscripciones.alumno_id) as total_alumnos'),
                DB::raw('COUNT(DISTINCT CASE WHEN inscripciones.estado = 1 THEN inscripciones.alumno_id END) as alumnos_completados')
            )
            ->join('alumnos', 'inscripciones.alumno_id', '=', 'alumnos.id')
            ->join('semestres', function($join) use ($periodoActual) {
                $join->on('alumnos.id', '=', 'semestres.alumno_id')
                    ->where('semestres.periodo_id', '=', $periodoActual);
            })
            ->groupBy('semestres.numero_semestre')
            ->orderBy('semestres.numero_semestre')
            ->get();

        // Estadísticas de progreso diario
        $progresoDiario = Inscripcion::where('periodo_id', $periodoActual)
            ->where('activa', 1)
            ->select(
                DB::raw('DATE(inscripciones.updated_at) as fecha'),
                DB::raw('COUNT(DISTINCT CASE WHEN inscripciones.estado = 1 THEN inscripciones.alumno_id END) as completados')
            )
            ->where('estado', 1)
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        return view('estadisticas.index', compact(
            'planteles',
            'plantelSeleccionado',
            'estadisticas',
            'estadisticasSemestre',
            'progresoDiario'
        ));
    }
} 