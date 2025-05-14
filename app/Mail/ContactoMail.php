<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $mensaje;

    public function __construct($email, $mensaje)
    {
        $this->email = $email;
        $this->mensaje = $mensaje;
    }

    public function build()
    {
        return $this->subject('Nuevo mensaje de contacto - CAD')
                    ->view('emails.contacto')
                    ->with([
                        'email' => $this->email,
                        'mensaje' => $this->mensaje
                    ]);
    }
} 