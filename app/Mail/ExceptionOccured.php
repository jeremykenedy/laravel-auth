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
        return $this->from($this->resolveConfigValue('emailExceptionFrom', 'emailExceptionFromDefault'))
            ->to($this->resolveRecipients('emailExceptionsTo', 'emailExceptionsToDefault'))
            ->cc($this->resolveRecipients('emailExceptionCCto', 'emailExceptionCCtoDefault'))
            ->bcc($this->resolveRecipients('emailExceptionBCCto', 'emailExceptionBCCtoDefault'))
            ->subject($this->resolveConfigValue('emailExceptionSubject', 'emailExceptionSubjectDefault'))
            ->view(config('exceptions.emailExceptionView'))
            ->with('content', $this->content);
    }

    /**
     * Resolve a comma-separated recipient list config, falling back to its default when empty.
     *
     * @param  string  $key
     * @param  string  $defaultKey
     * @return array
     */
    private function resolveRecipients($key, $defaultKey)
    {
        $recipients = str_getcsv(config('exceptions.'.$key), ',');

        if ($recipients[0] === null) {
            $recipients = config('exceptions.'.$defaultKey);
        }

        return $recipients;
    }

    /**
     * Resolve a single config value, falling back to its default when falsy.
     *
     * @param  string  $key
     * @param  string  $defaultKey
     * @return mixed
     */
    private function resolveConfigValue($key, $defaultKey)
    {
        $value = config('exceptions.'.$key);

        if (! $value) {
            $value = config('exceptions.'.$defaultKey);
        }

        return $value;
    }
}
