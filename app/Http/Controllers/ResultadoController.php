<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Models\Resultado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultadoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'respuesta_1' => 'required|numeric',
            'respuesta_2' => 'required|numeric',
            'respuesta_3' => 'required|numeric',
            'respuesta_4' => 'required|numeric',
            'respuesta_5' => 'required|numeric',
            'respuesta_6' => 'required|numeric',
            'respuesta_7' => 'required|numeric',
            'respuesta_8' => 'required|numeric',
            'respuesta_9' => 'required|numeric',
            'respuesta_10' => 'required|numeric',
            'respuesta_11' => 'required|numeric',
            'respuesta_12' => 'required|numeric',
            'respuesta_13' => 'required|numeric',
            'respuesta_14' => 'required|numeric',
            'respuesta_15' => 'required|numeric',
            'respuesta_16' => 'required|numeric',
            'respuesta_17' => 'required|numeric',
            'respuesta_18' => 'required|numeric',
            'respuesta_19' => 'required|numeric',
            'respuesta_20' => 'required|numeric',
            'respuesta_21' => 'required|numeric',
            'respuesta_22' => 'required|numeric',
            'respuesta_23' => 'required|numeric',
            'respuesta_24' => 'required|numeric',
            'respuesta_25' => 'required|numeric',
            'respuesta_26' => 'required|numeric',
            'respuesta_27' => 'required|numeric',
            'respuesta_28' => 'required|numeric',
            'respuesta_29' => 'required|numeric',
            'inscripcion_id' => 'required|numeric',
        ]);

        $alumno = new Alumno();
        $alumno_id = $alumno->getAlumnoId(Auth::user()->id);

        $selectedValues = [];
        for ($i = 1; $i <= 29; $i++) {
            $selectedValues["respuesta_$i"] = $request->input("respuesta_$i");

            Resultado::create([
                'alumno_id' => $alumno_id['id'],
                'pregunta_id' => $i,
                'respuesta_id' => $request->input("respuesta_$i"),
                'periodo_id' => 1,
            ]);
        }

        Inscripcion::where('id', $request->input("inscripcion_id"))
            ->update(['estado' => 1]);

        return redirect()->route('dashboard')
            ->with('success','¡Evaluación completada con exito!.');
    }
}
