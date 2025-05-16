<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuestionario;

class PreguntaController extends Controller
{
    public function index(Request $request)
    {
        \Log::info('Accediendo a preguntas', [
            'cuestionario_id' => $request->cuestionario_id,
            'user_id' => auth()->id(),
            'params' => $request->all()
        ]);

        if (!$request->has('cuestionario_id')) {
            \Log::warning('No se proporcionó cuestionario_id');
            return redirect()->route('cuestionarios')
                ->with('error', 'Debe seleccionar un cuestionario para ver sus preguntas.');
        }

        try {
            $cuestionario = Cuestionario::with([
                'preguntas' => function($query) {
                    $query->orderBy('id');
                },
                'preguntas.rubro'
            ])->findOrFail($request->cuestionario_id);

            \Log::info('Cuestionario encontrado', [
                'id' => $cuestionario->id,
                'titulo' => $cuestionario->titulo,
                'preguntas_count' => $cuestionario->preguntas->count(),
                'preguntas' => $cuestionario->preguntas->map(function($pregunta) {
                    return [
                        'id' => $pregunta->id,
                        'titulo' => $pregunta->titulo,
                        'rubro' => $pregunta->rubro ? $pregunta->rubro->nombre : null
                    ];
                })->toArray()
            ]);

            if ($cuestionario->preguntas->isEmpty()) {
                \Log::warning('El cuestionario no tiene preguntas', ['cuestionario_id' => $request->cuestionario_id]);
            }

            return view('preguntas', [
                'cuestionario_id' => (int)$request->cuestionario_id,
                'cuestionario' => $cuestionario
            ]);
        } catch (\Exception $e) {
            \Log::error('Error al cargar cuestionario', [
                'cuestionario_id' => $request->cuestionario_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('cuestionarios')
                ->with('error', 'El cuestionario seleccionado no existe.');
        }
    }
}
