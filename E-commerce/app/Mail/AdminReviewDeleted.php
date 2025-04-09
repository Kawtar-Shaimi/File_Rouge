<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminReviewDeleted extends Mailable
{
    public $user, $book , $admin_name;

    public function __construct($user, $book, $admin_name)
    {
        $this->user = $user;
        $this->book = $book;
        $this->admin_name = $admin_name;
    }

    public function build()
    {
        return $this->view('emails.admin.reviews.review-deleted')
            ->subject('Review Deleted')
            ->with([
                'user' => $this->user,
                'book' => $this->book,
                'admin_name' => $this->admin_name
            ]);
    }
}
