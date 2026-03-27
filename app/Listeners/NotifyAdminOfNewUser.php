<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;

class NotifyAdminOfNewUser
{
    public function handle(Registered $event): void
    {
        $newUser = $event->user;

        // Notify all admins about the new registration
        $admins = User::whereHas('roles', function ($q) {
            $q->where('level', '>=', 5);
        })->get();

        foreach ($admins as $admin) {
            $admin->notifications()->create([
                'id' => Str::uuid()->toString(),
                'type' => 'App\\Notifications\\NewUserRegistered',
                'data' => [
                    'title' => 'New User Registered',
                    'message' => "{$newUser->name} ({$newUser->email}) just registered.",
                    'action_url' => '/users/'.$newUser->id,
                    'action_text' => 'View User',
                ],
            ]);
        }
    }
}
