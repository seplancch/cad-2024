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
use Carbon\Carbon;

use function App\Helpers\compruebaEstadoInscripciones;
use function App\Helpers\obtieneIdPeriodoActual;
use function App\Helpers\obtienePeriodoActual;
use function App\Helpers\verificaCuestionarioServiciosUnam;

class PanelController extends Controller
{
    public function index()
    {
        $usuario = auth()->user();
        $roles = $usuario->getRoleNames();

        // Si el usuario es profesor por columna tipo
        if ($usuario->tipo === 'P') {
            return view('panel.profesor');
        }
        if ($roles->contains('Admin')) {
            return view('panel.admin');
        } elseif ($roles->contains('Profesor')) {
            // Redirigir a panel de profesor con Livewire
            return view('panel.profesor');
        } else {
            $periodo = obtieneIdPeriodoActual();
            $alm = new Alumno();
            $alumno = $alm->getAlumnoId($usuario->id);
            $semestre = $alm->getSemestre($alumno->id, $periodo);

            if ($semestre == 6) {
                $inicio = Configuracion::where('nombre', 'INICIO_6')->first();
                $cierre = Configuracion::where('nombre', 'CIERRE_6')->first();
            } else {
                $inicio = Configuracion::where('nombre', 'INICIO_24')->first();
                $cierre = Configuracion::where('nombre', 'CIERRE_24')->first();
            }

            $fechaActual = Carbon::now();
            $fechaInicio = Carbon::createFromFormat('d-m-Y', $inicio->valor);
            $fechaCierre = Carbon::createFromFormat('d-m-Y', $cierre->valor);
            $fechaCierre->setTime(23, 59, 59);

            $fueraDeRango = !$fechaActual->between($fechaInicio, $fechaCierre);
            $periodoActual = obtienePeriodoActual();
            $inscripciones = $usuario->inscripcion->where('periodo_id', $periodo);

            // Validar cuestionario de servicios UNAM
            $serviciosUnamCompleto = verificaCuestionarioServiciosUnam($alumno->numero_cuenta);

            return view('panel.index', compact(
                'inscripciones',
                'usuario',
                'semestre',
                'periodoActual',
                'fueraDeRango',
                'fechaInicio',
                'fechaCierre',
                'serviciosUnamCompleto'
            ));
        }
    }

    public function reporte()
    {
        $usuario = auth()->user();
        $periodo = new \stdClass();
        $periodo->clave = obtienePeriodoActual();
        $periodo->id = obtieneIdPeriodoActual();
        $inscripciones = $usuario->inscripcion->where('periodo_id', $periodo->id);

        if (compruebaEstadoInscripciones($usuario->id)->estado == 1) {
            $alm = new Alumno();
            $alumno = $alm->getAlumnoId($usuario->id);
            $semestre = $alm->getSemestre($alumno->id, $periodo->id);
            $linkvalidacion = 'https://cad.cch.unam.mx/validar/' . $alumno->numero_cuenta . '-' . $periodo->clave;

            // Validar cuestionario de servicios UNAM
            $serviciosUnamCompleto = verificaCuestionarioServiciosUnam($alumno->numero_cuenta);
            if ($semestre != 6 && $serviciosUnamCompleto !== 1) {
                return redirect()->route('dashboard')
                    ->with('error', 'No puedes descargar el comprobante porque no has completado el Cuestionario de Opinión de los Servicios de la UNAM.');
            }

            // Obtener la clave_comprobante del usuario
            $claveComprobante = $usuario->comprobanteCad ?
                $usuario->comprobanteCad->clave_comprobante : null;

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
            $qrImagenPublic = asset('storage/qr/' . $qrFileName); // Ruta accesible para DomPDF

            $pdf = Pdf::loadView(
                'panel.reporte',
                compact(
                    'inscripciones',
                    'semestre',
                    'alumno',
                    'qrImagenPublic', // Usar esta variable en la vista
                    'periodo',
                    'linkvalidacion',
                    'claveComprobante'
                )
            );
            $pdf->setPaper('letter');
            $pdf->setEncryption('', 'CAD2024', ['print']); // Permite impresión, protege contra modificaciones

            $response = $pdf->download(
                'comprobante_cad_' . $alumno->numero_cuenta . '.pdf'
            );
            File::delete($qrImagen); // Eliminar después de enviar el PDF
            return $response;
        } else {
            return redirect()->route('dashboard')
                ->with('error', 'No se puede generar el reporte, por favor completa todas tus inscripciones');
        }
    }
}
