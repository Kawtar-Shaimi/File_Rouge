<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PublisherBookRemoved extends Mailable
{
    public $user, $book_name;

    public function __construct($user, $book_name)
    {
        $this->user = $user;
        $this->book_name = $book_name;
    }

    public function build()
    {
        return $this->view('emails.publisher.books.book-deleted-admin')
            ->subject('Book Deleted')
            ->with([
                'user' => $this->user,
                'book_name' => $this->book_name,
            ]);
    }
}
