<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to '.config('app.name'))
            ->greeting('Hello '.$notifiable->name.'!')
            ->line('Welcome to '.config('app.name').'. Your account has been created successfully.')
            ->action('Complete Your Profile', url('/profile/edit'))
            ->line('We recommend completing your profile and enabling two-factor authentication for added security.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Welcome to '.config('app.name'),
            'message' => 'Your account has been created. Complete your profile to get started.',
            'action_url' => '/profile/edit',
            'action_text' => 'Complete Profile',
        ];
    }
}
