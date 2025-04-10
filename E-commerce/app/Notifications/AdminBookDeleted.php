<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminBookDeleted extends Notification
{
    use Queueable;

    public $book_name, $publisher_name, $deletedAt;

    public function __construct($book_name, $publisher_name)
    {
        $this->book_name = $book_name;
        $this->publisher_name = $publisher_name;
        $this->deletedAt = now();
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'url' => route('admin.books.index'),
            'url_text' => 'View all books',
            'message' => "The book {$this->book_name} by {$this->publisher_name} has been deleted at {$this->deletedAt} by his publisher",
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'url' => route('admin.books.index'),
            'url_text' => 'View all books',
            'message' => "The book {$this->book_name} by {$this->publisher_name} has been deleted at {$this->deletedAt} by his publisher",
        ];
    }
}
