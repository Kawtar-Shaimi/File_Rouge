<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminBookRemoved extends Mailable
{
    public $user, $book_name, $admin_name, $deletedAt;

    public function __construct($user, $book_name, $admin_name)
    {
        $this->user = $user;
        $this->book_name = $book_name;
        $this->admin_name = $admin_name;
        $this->deletedAt = now();
    }

    public function build()
    {
        return $this->view('emails.admin.books.book-deleted-admin')
            ->subject('Book Deleted')
            ->with([
                'user' => $this->user,
                'book_name' => $this->book_name,
                'admin_name' => $this->admin_name,
                'deletedAt' => $this->deletedAt
            ]);
    }
}
