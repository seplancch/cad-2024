<?php
/**
 * ProfesorController
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   Jonathan <jonathan@example.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://example.com
 * @since    PHP 7.4
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Grupo;
use Barryvdh\DomPDF\Facade\Pdf as PDF;



/**
 * Handles professor-related actions.
 */
class ProfesorController extends Controller
{
    /**
     * Genera y descarga el comprobante del profesor en formato PDF.
     *
     * @return \Illuminate\Http\Response
     */
    public function generarComprobantePDF()
    {
        $profesor = Auth::user();
        $data = [
            'nombre' => $profesor->name,
            'email' => $profesor->email,
            'fecha' => now()->format('d/m/Y'),
            'grupos' => Grupo::where('profesor_id', $profesor->id)->get(),
        ];

        $pdf = PDF::loadView('pdf.comprobante-profesor', $data);

        return $pdf->download('comprobante_profesor.pdf');
    }
}
