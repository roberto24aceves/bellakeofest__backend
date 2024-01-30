<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'mail.bellakeofest.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'noreply@bellakeofest.com'; // SMTP username
            $mail->Password = 'Temporal123'; // SMTP password

            /*$mail->Host = 'smtp.gmail.com';
            $mail->Username = 'ivancitoenano27@gmail.com';
            $mail->Password = 'wxka rjwe qjjb dkav';*/

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->setFrom('noreply@bellakeofest.com', 'Bellakeofest');
            $mail->addAddress($request->email, $request->name); // Add a recipient
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
            return response()->json(['message' => 'Email has been sent']);
        } catch (Exception $e) {
            dd($e);
            return response()->json(['message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
        }


    }
}
