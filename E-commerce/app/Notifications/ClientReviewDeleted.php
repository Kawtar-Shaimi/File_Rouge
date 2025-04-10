<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClientReviewDeleted extends Notification
{
    use Queueable;

    public $book;

    public function __construct($book)
    {
        $this->book = $book;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "Your review for the book {$this->book->name} has been deleted by the admins",
            'url' => route('books.show', $this->book->uuid),
            'url_text' => 'View book'
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Your review for the book {$this->book->name} has been deleted by the admins",
            'url' => route('books.show', $this->book->uuid),
            'url_text' => 'View book'
        ];
    }
}
