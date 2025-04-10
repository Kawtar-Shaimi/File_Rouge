<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PublisherBookUpdated extends Notification
{
    use Queueable;

    public $book_name, $book_uuid;

    public function __construct($book_name, $book_uuid)
    {
        $this->book_name = $book_name;
        $this->book_uuid = $book_uuid;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "Your book {$this->book_name} has been updated successfully",
            'url' => route('publisher.books.show', $this->book_uuid),
            'url_text' => 'View book',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Your book {$this->book_name} has been updated successfully",
            'url' => route('publisher.books.show', $this->book_uuid),
            'url_text' => 'View book',
        ];
    }
}
