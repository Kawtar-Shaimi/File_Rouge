<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PublisherOrderPlaced extends Mailable
{
    public $user, $order;

    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    public function build()
    {
        return $this->view('emails.publisher.orders.order-placed')
            ->subject('Order Placed')
            ->with([
                'user' => $this->user,
                'order' => $this->order,
            ]);
    }
}
