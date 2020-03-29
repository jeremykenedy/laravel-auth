<?php

namespace App\Traits;

use ReCaptcha\ReCaptcha;
use Request;

trait CaptchaTrait
{
    /**
     * Check Google Captcha Passed or Failed.
     *
     * @return bool
     */
    public function captchaCheck()
    {
        $response = Request::get('g-recaptcha-response');
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $secret = config('settings.reCaptchSecret');

        $recaptcha = new ReCaptcha($secret);
        $resp = $recaptcha->verify($response, $remoteip);

        if ($resp->isSuccess()) {
            return true;
        }

        return false;
    }
}
