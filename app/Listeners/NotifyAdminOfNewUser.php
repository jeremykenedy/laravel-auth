<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NewUserRegisteredNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;

class NotifyAdminOfNewUser
{
    public function handle(Registered $event): void
    {
        $newUser = $event->user;

        $admins = User::whereHas('roles', function ($q) {
            $q->where('level', '>=', 5);
        })->get();

        Notification::send($admins, new NewUserRegisteredNotification(
            userName: $newUser->name,
            userEmail: $newUser->email,
            userId: $newUser->id,
        ));
    }
}
