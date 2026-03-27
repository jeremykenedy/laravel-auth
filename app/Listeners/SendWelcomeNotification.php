<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;

class SendWelcomeNotification
{
    public function handle(Registered $event): void
    {
        $user = $event->user;

        // Create a database notification welcoming the user
        $user->notifications()->create([
            'id' => Str::uuid()->toString(),
            'type' => 'App\\Notifications\\WelcomeNotification',
            'data' => [
                'title' => 'Welcome to '.config('app.name'),
                'message' => 'Your account has been created. Complete your profile to get started.',
                'action_url' => '/profile/edit',
                'action_text' => 'Complete Profile',
            ],
        ]);
    }
}
