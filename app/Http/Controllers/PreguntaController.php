<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    public function index(Request $request)
    {
        $cuestionario_id = $request->get('cuestionario_id', 0);
        return view('preguntas', compact('cuestionario_id'));
    }
}
