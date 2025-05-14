<?php

namespace App\Http\Controllers\Inicio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contacto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoMail;

class InicioController extends Controller
{
    public function index()
    {
        return view('inicio.inicio');
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
            'mensaje' => 'required|min:10'
        ], [
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'El correo electrónico debe ser válido',
            'email.ends_with' => 'El correo electrónico debe ser del dominio @cch.unam.mx',
            'mensaje.required' => 'El mensaje es obligatorio',
            'mensaje.min' => 'El mensaje debe tener al menos 10 caracteres'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
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
