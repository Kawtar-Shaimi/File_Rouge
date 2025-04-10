<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminBookUpdated extends Notification
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
            'message' => "The book {$this->book->name} by {$this->book->publisher->name} has been updated by his publisher",
            'url' => route('admin.books.show', $this->book->uuid),
            'url_text' => 'View book',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "The book {$this->book->name} by {$this->book->publisher->name} has been updated by his publisher",
            'url' => route('admin.books.show', $this->book->uuid),
            'url_text' => 'View book',
        ];
    }
}
