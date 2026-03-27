<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class LogUserLogin
{
    public function handle(Login $event): void
    {
        $user = $event->user;

        if (method_exists($user, 'setSignupIp')) {
            // Update last login IP via the ip-capture package
        }

        // The laravel-logger package handles activity logging via its own middleware
        // This listener is for any additional login-specific logic
    }
}
