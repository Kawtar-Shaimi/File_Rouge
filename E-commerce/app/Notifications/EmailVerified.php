<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerified extends Notification
{
    use Queueable;

    public $user, $guard;

    public function __construct($user, $guard)
    {
        $this->user = $user;
        $this->guard = $guard;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "Your email has been verified successfully",
            'url' => match ($this->guard) {
                'admin' => route('admin.profile'),
                'publisher' => route('publisher.profile'),
                default => route('client.index')
            },
            'url_text' => 'View profile',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Your email has been verified successfully",
            'url' => match ($this->guard) {
                'admin' => route('admin.profile'),
                'publisher' => route('publisher.profile'),
                default => route('client.index')
            },
            'url_text' => 'View profile',
        ];
    }
}
