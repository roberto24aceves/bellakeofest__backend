<?php

namespace App\Listeners;

use App\Events\event_participantes;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Emailbienvenida
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\event_participantes  $event
     * @return void
     */
    public function handle(event_participantes $event)
    {
        
        try{
            $mail = new PHPMailer(true);
            $mail ->Host      = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ivancitoenano27@gmail.com';     
            $mail->Password   = 'wxka rjwe qjjb dkav';     
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;                

        // Destinatarios
            $mail->setFrom('empresa@gmail.com', 'Empresa');
            $mail->addAddress($event-> client-> email);     

        // Contenido del correo
            $mail->isHTML(true);                                  
            $mail->Subject = 'Mensaje de bienvenida';
            $mail->Body    = 'Bienvenido, se ha registrado correctamente';
            $mail->AltBody = 'bienvenido';

            $mail->send();
            echo 'Correo enviado, revise su correo electronico';
        }
        catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
        }        
        
        
    }
}
