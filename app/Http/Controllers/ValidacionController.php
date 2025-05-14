<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use function App\Helpers\obtieneIdPeriodoActual;

class ValidacionController extends Controller
{
    public function validar($codigo)
    {
        // El código viene en formato: numero_cuenta-año-semestre
        $partes = explode('-', $codigo);
        
        if (count($partes) !== 3) {
            return view('validacion.error', [
                'mensaje' => 'Código de validación inválido',
                'detalles' => 'El formato del código no es correcto. Debe ser: número_cuenta-año-semestre'
            ]);
        }

        $numeroCuenta = $partes[0];
        $periodo = $partes[1] . '-' . $partes[2]; // Reconstruimos el periodo como "año-semestre"

        // Buscar el alumno
        $alumno = Alumno::where('numero_cuenta', $numeroCuenta)->first();
        
        if (!$alumno) {
            return view('validacion.error', [
                'mensaje' => 'Alumno no encontrado',
                'detalles' => 'El número de cuenta no está registrado en el sistema'
            ]);
        }

        // Obtener las inscripciones del alumno para el periodo
        $inscripciones = Inscripcion::whereHas('grupo', function($query) use ($periodo) {
            $query->whereHas('periodo', function($q) use ($periodo) {
                $q->where('clave', $periodo);
            });
        })
        ->where('alumno_id', $alumno->id)
        ->where('activa', 1)
        ->get();

        if ($inscripciones->isEmpty()) {
            return view('validacion.error', [
                'mensaje' => 'No se encontraron evaluaciones',
                'detalles' => 'No hay registros de evaluaciones para este alumno en el periodo especificado'
            ]);
        }

        // Verificar si todas las evaluaciones están completadas
        $totalGrupos = $inscripciones->count();
        $completados = $inscripciones->where('estado', 1)->count();
        $valido = $totalGrupos === $completados && $totalGrupos > 0;

        return view('validacion.resultado', [
            'valido' => $valido,
            'alumno' => $alumno,
            'periodo' => $periodo,
            'totalGrupos' => $totalGrupos,
            'completados' => $completados,
            'inscripciones' => $inscripciones
        ]);
    }
} 