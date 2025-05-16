<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuestionario;
use App\Models\Inscripcion;
use App\Models\Periodo;
use App\Models\Rubro;

use function App\Helpers\obtieneIdPeriodoActual;

class CuestionarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('cuestionarios');
    }

    public function show($id)
    {
        $cuestionario = Cuestionario::with('preguntas.rubro')->findOrFail($id);
        return view('cuestionarios.show', compact('cuestionario'));
    }
}
