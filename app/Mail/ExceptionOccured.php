<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExceptionOccured extends Mailable
{
    use Queueable, SerializesModels;

    private $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailsTo = str_getcsv(config('exceptions.emailExceptionsTo'), ',');
        $ccEmails = str_getcsv(config('exceptions.emailExceptionCCto'), ',');
        $bccEmails = str_getcsv(config('exceptions.emailExceptionBCCto'), ',');
        $fromSender = config('exceptions.emailExceptionFrom');
        $subject = config('exceptions.emailExceptionSubject');

        if ($emailsTo[0] == null) {
            $emailsTo = config('exceptions.emailExceptionsToDefault');
        }

        if ($ccEmails[0] == null) {
            $ccEmails = config('exceptions.emailExceptionCCtoDefault');
        }

        if ($bccEmails[0] == null) {
            $bccEmails = config('exceptions.emailExceptionBCCtoDefault');
        }

        if (!$fromSender) {
            $fromSender = config('exceptions.emailExceptionFromDefault');
        }

        if (!$subject) {
            $subject = config('exceptions.emailExceptionSubjectDefault');
        }

        return $this->from($fromSender)
                    ->to($emailsTo)
                    ->cc($ccEmails)
                    ->bcc($bccEmails)
                    ->subject($subject)
                    ->view(config('exceptions.emailExceptionView'))
                    ->with('content', $this->content);
    }
}
