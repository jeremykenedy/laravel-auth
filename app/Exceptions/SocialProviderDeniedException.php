<?php

namespace App\Exceptions;

use Exception;

class SocialProviderDeniedException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->view('socialite.denied', [], 401);
    }
}
