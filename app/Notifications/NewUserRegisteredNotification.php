<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewUserRegisteredNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected string $userName,
        protected string $userEmail,
        protected int $userId,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New User Registered',
            'message' => "{$this->userName} ({$this->userEmail}) just registered.",
            'action_url' => '/users/'.$this->userId,
            'action_text' => 'View User',
        ];
    }
}
