<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PublisherBookUpdated extends Mailable
{
    public $user, $book_name, $book_uuid;

    public function __construct($user, $book_name, $book_uuid)
    {
        $this->user = $user;
        $this->book_name = $book_name;
        $this->book_uuid = $book_uuid;
    }

    public function build()
    {
        return $this->view('emails.publisher.books.book-updated')
            ->subject('Book Updated')
            ->with([
                'user' => $this->user,
                'book_name' => $this->book_name,
                'book_uuid' => $this->book_uuid
            ]);
    }
}
