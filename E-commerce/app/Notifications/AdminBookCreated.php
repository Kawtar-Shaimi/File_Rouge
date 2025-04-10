<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminBookCreated extends Notification
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
            'message' => "A new book titled {$this->book->name} by {$this->book->publisher->name} has been added to our platform",
            'url' => route('admin.books.show', $this->book->uuid),
            'url_text' => 'View book',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "A new book titled {$this->book->name} by {$this->book->publisher->name} has been added to our platform",
            'url' => route('admin.books.show', $this->book->uuid),
            'url_text' => 'View book',
        ];
    }
}
