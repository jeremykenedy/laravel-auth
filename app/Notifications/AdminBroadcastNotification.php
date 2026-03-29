<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminBroadcastNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected string $title,
        protected string $message,
        protected ?string $actionUrl = null,
        protected ?string $actionText = null,
        protected bool $sendEmail = false,
    ) {}

    public function via(object $notifiable): array
    {
        $channels = ['database'];

        if ($this->sendEmail) {
            $channels[] = 'mail';
        }

        return $channels;
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject($this->title)
            ->line($this->message);

        if ($this->actionUrl) {
            $mail->action($this->actionText ?? 'View', $this->actionUrl);
        }

        return $mail;
    }

    public function toArray(object $notifiable): array
    {
        $data = [
            'title' => $this->title,
            'message' => $this->message,
        ];

        if ($this->actionUrl) {
            $data['action_url'] = $this->actionUrl;
            $data['action_text'] = $this->actionText ?? 'View';
        }

        return $data;
    }
}
