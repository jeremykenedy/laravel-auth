<?php namespace App\Logic\Mailers;

abstract class Mailer {

    public function sendTo($email, $subject, $fromEmail, $view, $data = [])
    {
        \Mail::queue($view, $data, function($message) use($email, $subject, $fromEmail)
        {

            $message->from($fromEmail, 'jeremykenedy@gmail.com');

            $message->to($email)
                ->subject($subject);
        });
    }
}