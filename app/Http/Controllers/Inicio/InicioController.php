<?php

namespace App\Http\Controllers\Inicio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contacto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoMail;
use Illuminate\Support\Facades\Http;
use App\Models\Configuracion;
use Carbon\Carbon;

class InicioController extends Controller
{
    public function index()
    {
        $inicio6 = Configuracion::where('nombre', 'INICIO_6')->first();
        $cierre6 = Configuracion::where('nombre', 'CIERRE_6')->first();
        $inicio24 = Configuracion::where('nombre', 'INICIO_24')->first();
        $cierre24 = Configuracion::where('nombre', 'CIERRE_24')->first();

        // Array de meses en español
        $meses = [
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre'
        ];

        $fechas = [
            'inicio6' => $inicio6 ? Carbon::createFromFormat('d-m-Y', $inicio6->valor)->format('d') : '',
            'cierre6' => $cierre6 ? Carbon::createFromFormat('d-m-Y', $cierre6->valor)->format('d') : '',
            'inicio24' => $inicio24 ? Carbon::createFromFormat('d-m-Y', $inicio24->valor)->format('d') : '',
            'cierre24' => $cierre24 ? Carbon::createFromFormat('d-m-Y', $cierre24->valor)->format('d') : '',
            'mesInicio6' => $inicio6 ? $meses[Carbon::createFromFormat('d-m-Y', $inicio6->valor)->format('F')] : '',
            'mesCierre6' => $cierre6 ? $meses[Carbon::createFromFormat('d-m-Y', $cierre6->valor)->format('F')] : '',
            'mesInicio24' => $inicio24 ? $meses[Carbon::createFromFormat('d-m-Y', $inicio24->valor)->format('F')] : '',
            'mesCierre24' => $cierre24 ? $meses[Carbon::createFromFormat('d-m-Y', $cierre24->valor)->format('F')] : '',
        ];

        return view('inicio.inicio', compact('fechas'));
    }

    public function contacto()
    {
        return view('inicio.contacto');
    }

    public function creditos()
    {
        return view('inicio.creditos');
    }

    public function preguntasFrecuentes()
    {
        return view('inicio.preguntas-frecuentes');
    }

    public function queEs()
    {
        return view('inicio.que-es');
    }

    public function recursos()
    {
        return view('inicio.recursos');
    }

    public function enviarContacto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|ends_with:@cch.unam.mx',
            'mensaje' => 'required|min:10',
            'g-recaptcha-response' => 'required'
        ], [
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'El correo electrónico debe ser válido',
            'email.ends_with' => 'El correo electrónico debe ser del dominio @cch.unam.mx',
            'mensaje.required' => 'El mensaje es obligatorio',
            'mensaje.min' => 'El mensaje debe tener al menos 10 caracteres',
            'g-recaptcha-response.required' => 'Por favor, verifica que no eres un robot'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verificar reCAPTCHA
        $recaptcha = $request->input('g-recaptcha-response');
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $recaptcha,
            'remoteip' => $request->ip()
        ]);

        if (!$response->json('success')) {
            return redirect()->back()
                ->with('error', 'Error en la verificación de reCAPTCHA. Por favor, intenta nuevamente.')
                ->withInput();
        }

        try {
            Mail::to('contacto@cch.unam.mx')->send(new ContactoMail($request->email, $request->mensaje));
            
            return redirect()->back()
                ->with('success', '¡Gracias por tu mensaje! Te responderemos a la brevedad.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al enviar el mensaje. Por favor, intenta nuevamente más tarde.')
                ->withInput();
        }
    }
}
