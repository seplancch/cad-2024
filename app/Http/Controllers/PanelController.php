<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Configuracion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use PSpell\Config;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

use function App\Helpers\compruebaEstadoInscripciones;

class PanelController extends Controller
{
    public function index()
    {

        $usuario = auth()->user();
        $periodo = Configuracion::find(1)->periodo;

        $roles = $usuario->getRoleNames(); // Returns a collection

        if ($roles->contains('Admin')) {
            return view('panel.admin');
        }else{
            $inscripciones = $usuario->inscripcion->where('periodo_id', $periodo->id);

            $alm = new Alumno();
            $alumno = $alm->getAlumnoId($usuario->id);
            $semestre = $alm->getSemestre($alumno->id, $periodo->id);

            return view('panel.index', compact('inscripciones', 'usuario', 'semestre', 'periodo'));
        }
    }

    public function report()
    {
        $usuario = auth()->user();
        $periodo = Configuracion::find(1)->periodo;
        $inscripciones = $usuario->inscripcion->where('periodo_id', $periodo->id);

        if(compruebaEstadoInscripciones($usuario->id)->estado == 1){
            $alm = new Alumno();
            $alumno = $alm->getAlumnoId($usuario->id);
            $semestre = $alm->getSemestre($alumno->id, $periodo->id);
            $linkvalidacion = 'https://cad.cch.unam.mx/validate/'.$alumno->numero_cuenta.'-'.$periodo->clave;

            $renderer = new ImageRenderer(
                new RendererStyle(400),
                new ImagickImageBackEnd()
            );

            $writer = new Writer($renderer);
            $writer->writeFile($linkvalidacion, 'qrcode.png');
            $qrImagen = 'qrcode.png';


            $pdf = Pdf::loadView('panel.reporte',compact('inscripciones', 'semestre', 'alumno', 'qrImagen', 'periodo', 'linkvalidacion'));
            $pdf->setEncryption('', 5678, ['modify', 'copy', 'add']);


            return $pdf->stream('comprobante_cad_'.$alumno->numero_cuenta.'.pdf');
            //return $pdf->download('comprobante_cad_'.$alumno->numero_cuenta.'.pdf');
        }else{
            return redirect()->route('dashboard')->with('error', 'No se puede generar el reporte, por favor completa todas tus inscripciones');
        }
    }
}
