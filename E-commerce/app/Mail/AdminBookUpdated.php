<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminBookUpdated extends Mailable
{
    public $user, $book;

    public function __construct($user, $book)
    {
        $this->user = $user;
        $this->book = $book;
    }

    public function build()
    {
        return $this->view('emails.admin.books.book-updated')
            ->subject('Book Updated')
            ->with([
                'user' => $this->user,
                'book' => $this->book
            ]);
    }
}
