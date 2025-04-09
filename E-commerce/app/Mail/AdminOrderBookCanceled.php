<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminOrderBookCanceled extends Mailable
{
    public $user, $order, $reason, $book_name;

    public function __construct($user, $order, $reason, $book_name)
    {
        $this->user = $user;
        $this->order = $order;
        $this->reason = $reason;
        $this->book_name = $book_name;
    }

    public function build()
    {
        return $this->view('emails.admin.orders.order-book-canceled')
            ->subject('Book Canceled From Order')
            ->with([
                'user' => $this->user,
                'order' => $this->order,
                'reason' => $this->reason,
                'book_name' => $this->book_name
            ]);
    }
}
