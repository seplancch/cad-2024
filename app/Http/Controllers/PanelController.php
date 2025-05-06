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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use function App\Helpers\compruebaEstadoInscripciones;
use function App\Helpers\obtieneIdPeriodoActual;
use function App\Helpers\obtienePeriodoActual;

class PanelController extends Controller
{
    public function index()
    {

        $usuario = auth()->user();


        $roles = $usuario->getRoleNames(); // Returns a collection

        if ($roles->contains('Admin')) {
            return view('panel.admin');
        } else {
            $periodo = obtieneIdPeriodoActual();
            $periodoActual = obtienePeriodoActual();
            $inscripciones = $usuario->inscripcion->where('periodo_id', $periodo);

            $alm = new Alumno();
            $alumno = $alm->getAlumnoId($usuario->id);
            $semestre = $alm->getSemestre($alumno->id, $periodo);

            return view('panel.index', compact('inscripciones', 'usuario', 'semestre', 'periodoActual'));
        }
    }

    public function report()
    {
        $usuario = auth()->user();
        $periodo = new \stdClass();
        $periodo->clave = obtienePeriodoActual();
        $periodo->id = obtieneIdPeriodoActual();
        $inscripciones = $usuario->inscripcion->where('periodo_id', $periodo->id);

        if(compruebaEstadoInscripciones($usuario->id)->estado == 1){
            $alm = new Alumno();
            $alumno = $alm->getAlumnoId($usuario->id);
            $semestre = $alm->getSemestre($alumno->id, $periodo->id);
            $linkvalidacion = 'https://cad.cch.unam.mx/validate/'.$alumno->numero_cuenta.'-'.$periodo->clave;

            $renderer = new ImageRenderer(
                new RendererStyle(200),
                new ImagickImageBackEnd()
            );

            $writer = new Writer($renderer);
            $qrFileName = 'qr_' . $alumno->numero_cuenta . '_' . $periodo->clave . '.png';
            $qrPath = 'public/qr/' . $qrFileName;
            Storage::makeDirectory('public/qr');
            $writer->writeFile($linkvalidacion, storage_path('app/' . $qrPath));
            $qrImagen = storage_path('app/' . $qrPath);

            $pdf = Pdf::loadView('panel.reporte', compact('inscripciones', 'semestre', 'alumno', 'qrImagen', 'periodo', 'linkvalidacion'));
            $pdf->setEncryption('', 'CAD2024', ['modify', 'copy', 'add']);

            $response = $pdf->stream('comprobante_cad_' . $alumno->numero_cuenta . '.pdf');
            File::delete($qrImagen);
            return $response;
            //return $pdf->download('comprobante_cad_'.$alumno->numero_cuenta.'.pdf');
        }else{
            return redirect()->route('dashboard')->with('error', 'No se puede generar el reporte, por favor completa todas tus inscripciones');
        }
    }
}
