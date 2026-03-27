<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Log;

class AuditSecurityEvent
{
    public function handleLogin(Login $event): void
    {
        Log::channel('security')->info('User logged in', [
            'user_id' => $event->user->id,
            'email' => $event->user->email,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    public function handleLogout(Logout $event): void
    {
        if ($event->user) {
            Log::channel('security')->info('User logged out', [
                'user_id' => $event->user->id,
                'email' => $event->user->email,
                'ip' => request()->ip(),
            ]);
        }
    }

    public function handlePasswordReset(PasswordReset $event): void
    {
        Log::channel('security')->warning('Password reset', [
            'user_id' => $event->user->id,
            'email' => $event->user->email,
            'ip' => request()->ip(),
        ]);
    }
}
