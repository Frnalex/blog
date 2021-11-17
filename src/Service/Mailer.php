<?php

namespace Alex\Src\Service;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Mailer
{
    public function sendMail($name, $email, $message)
    {
        // Create the Transport
        $transport = (new Swift_SmtpTransport($_ENV['SMTP_HOST'], $_ENV['SMTP_PORT']))
            ->setUsername($_ENV['SMTP_USERNAME'])
            ->setPassword($_ENV['SMTP_PASSWORD'])
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('Nouveau message reçu depuis le blog'))
            ->setFrom([$email => $name])
            ->setTo(['alexandre.fournou@gmail.com' => 'Alexandre Fournou'])
            ->setBody($message)
        ;

        // Send the message
        $result = $mailer->send($message);

        if ($result) {
            $this->session->set('email_send', 'Votre email a bien été envoyé');
        } else {
            $this->session->set('email_error', "Une erreur est survenue, votre mail n'a pas été envoyé");
        }
    }
}
