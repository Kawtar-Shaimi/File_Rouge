<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailLink extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Please verify your email address by clicking on the link sent to your email.',
            'url' => null,
            'url_text' => null,
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Please verify your email address by clicking on the link sent to your email.',
            'url' => null,
            'url_text' => null,
        ];
    }
}
