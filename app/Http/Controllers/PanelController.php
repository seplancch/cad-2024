<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

use function App\Helpers\compruebaEstadoInscripciones;

class PanelController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->id;
        $usuario = User::find($userid);

        $roles = $usuario->getRoleNames(); // Returns a collection

        if ($roles->contains('Admin')) {
            return view('panel.admin');
        }else{
            $inscripciones = $usuario->inscripcion;

            $alm = new Alumno();
            $alumno = $alm->getAlumnoId($userid);
            $semestre = $alm->getSemestre($alumno->id, 1);

            return view('panel.index', compact('inscripciones', 'usuario', 'semestre'));
        }
    }

    public function report()
    {
        $userid = Auth::user()->id;
        $usuario = User::find($userid);
        $inscripciones = $usuario->inscripcion;

        if(compruebaEstadoInscripciones($userid)->estado == 1){
            $alm = new Alumno();
            $alumno = $alm->getAlumnoId($userid);
            $semestre = $alm->getSemestre($alumno->id, 1);

            $pdf = Pdf::loadView('panel.reporte',compact('inscripciones', 'semestre', 'alumno'));
            $pdf->setEncryption('', 5678, ['modify', 'copy', 'add']);


            //return $pdf->stream('invoice.pdf');
            return $pdf->download('comprobante_cad_'.$alumno->numero_cuenta.'.pdf');
        }else{
            return redirect()->route('dashboard')->with('error', 'No se puede generar el reporte, por favor completa todas tus inscripciones');
        }
    }
}
