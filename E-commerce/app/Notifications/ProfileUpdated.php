<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProfileUpdated extends Notification
{
    use Queueable;

    public $guard;

    public function __construct($guard)
    {
        $this->guard = $guard;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Your profile has been updated successfully',
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
            'message' => 'Your profile has been updated successfully',
            'url' => match ($this->guard) {
                'admin' => route('admin.profile'),
                'publisher' => route('publisher.profile'),
                default => route('client.index')
            },
            'url_text' => 'View profile',
        ];
    }
}
