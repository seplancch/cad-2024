<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuestionario;
use App\Models\Inscripcion;
use App\Models\Periodo;
use App\Models\Rubro;
use Illuminate\Support\Facades\Auth;
use App\Models\Resultado;
use Illuminate\Support\Facades\DB;

use function App\Helpers\obtieneIdPeriodoActual;

class EvaluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        // Verificar que la inscripción pertenece al usuario actual
        $inscripcion = Inscripcion::where('id', $id)
            ->whereHas('alumno', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        if ($inscripcion->estado == '1') {
            return redirect()->route('dashboard')
                ->with('error', '¡Este profesor ya ha sido evaluado!');
        }

        // Obtener el cuestionario del periodo actual
        $periodo = Periodo::where('id', obtieneIdPeriodoActual())->first();
        $preguntas = Cuestionario::find($periodo->cuestionario_id)->preguntas;
        $rubros = Rubro::all();

        return view('evaluar.show', compact('preguntas', 'rubros', 'id', 'inscripcion'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
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
            ]
        );

        DB::beginTransaction();
        try {
            $selectedValues = [];
            for ($i = 1; $i <= 29; $i++) {
                $selectedValues["respuesta_$i"] = $request->input("respuesta_$i");

                Resultado::create(
                    [
                        'inscripcion_id' => $request->input("inscripcion_id"),
                        'pregunta_id' => $i,
                        'respuesta_id' => $request->input("respuesta_$i"),
                    ]
                );
            }

            Inscripcion::where('id', $request->input("inscripcion_id"))
                ->update(['estado' => 1]);

            DB::commit();

            return redirect()->route('dashboard')
                ->with('success', '¡Evaluación completada con éxito!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al guardar la evaluación: ' . $e->getMessage());
            return redirect()->route('dashboard')
                ->with('error', '¡Error al guardar la evaluación!: ' . $e->getMessage());
        }
    }
} 