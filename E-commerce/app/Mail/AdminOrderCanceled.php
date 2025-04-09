<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminOrderCanceled extends Mailable
{
    public $user, $order, $reason;

    public function __construct($user, $order, $reason)
    {
        $this->user = $user;
        $this->order = $order;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->view('emails.admin.orders.order-canceled')
            ->subject('Order Canceled')
            ->with([
                'user' => $this->user,
                'order' => $this->order,
                'reason' => $this->reason
            ]);
    }
}
