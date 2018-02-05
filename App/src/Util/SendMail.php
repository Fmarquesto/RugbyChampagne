<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 29/7/2017
 * Time: 11:54
 */

namespace App\Util;


use PHPMailer;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class SendMail
{
    public static function Send($body){
        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465))
            ->setUsername('fede.marquesto')
            ->setPassword('6422fede')
        ;

// Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

// Create a message
        $message = (new Swift_Message('Wonderful Subject'))
            ->setFrom(['john@doe.com' => 'John Doe'])
            ->setTo(['fede.marquesto@gmail.com', 'other@domain.org' => 'A name'])
            ->setBody('Here is the message itself')
        ;

// Send the message
        $result = $mailer->send($message);
    }
}