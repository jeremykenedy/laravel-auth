<?php namespace App\Logic\Mailers;

class UserMailer extends Mailer {

    public function verify($email, $data)
    {
        $view       = 'emails.activate-link';
        $subject    = $data['subject'];
        $fromEmail  = env('MAIL_USERNAME');

        $this->sendTo($email, $subject, $fromEmail, $view, $data);
    }

    public function passwordReset($email, $data)
    {
        $view       = 'emails.password-reset';
        $subject    = $data['subject'];
        $fromEmail  = env('MAIL_USERNAME');

        $this->sendTo($email, $subject, $fromEmail, $view, $data);
    }

}
