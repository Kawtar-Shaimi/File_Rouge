<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PublisherBookRemoved extends Notification
{
    use Queueable;

    public $book_name;

    public function __construct($book_name)
    {
        $this->book_name = $book_name;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "Your book {$this->book_name} has been deleted by the admins",
            'url' => route('publisher.books.index'),
            'url_text' => 'View all books',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Your book {$this->book_name} has been deleted by the admins",
            'url' => route('publisher.books.index'),
            'url_text' => 'View all books',
        ];
    }
}
