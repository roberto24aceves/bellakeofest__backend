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
            $mail->Host       = 'mail.bellakeofest.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'noreply@bellakeofest.com';
            $mail->Password   = 'Temporal123.$';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->setFrom('noreply@bellakeofest.com', 'BELLAKEOFEST');
            $mail->addAddress($event-> client-> email);
            $mail->isHTML(true);                                  
            $mail->Subject = 'Registro exitoso';
            $mail->Body    = 'Bellakeofest te da la bienvenida';
            $mail->AltBody = 'Bellakeofest te da la bienvenida';

            $mail->send();
        }
        catch (Exception $e) {
            var_dump($e);
        }
    }
}
