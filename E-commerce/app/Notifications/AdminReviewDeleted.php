<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminReviewDeleted extends Notification
{
    use Queueable;

    public $book , $admin_name;

    public function __construct($book, $admin_name)
    {
        $this->book = $book;
        $this->admin_name = $admin_name;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "The review for the book {$this->book->name} has been deleted by the admin {$this->admin_name}",
            'url' => route('admin.reviews.index'),
            'url_text' => 'View all reviews',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "The review for the book {$this->book->name} has been deleted by the admin {$this->admin_name}",
            'url' => route('admin.reviews.index'),
            'url_text' => 'View all reviews',
        ];
    }
}
