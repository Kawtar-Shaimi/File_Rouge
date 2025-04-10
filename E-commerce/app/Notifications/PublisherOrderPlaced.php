<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PublisherOrderPlaced extends Notification
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "A new order with the number {$this->order->order->order_number} for your book {$this->order->book->name} has been placed",
            'url' => route('publisher.orders.show', $this->order->uuid),
            'url_text' => 'View order',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "A new order with the number {$this->order->order->order_number} for your book {$this->order->book->name} has been placed",
            'url' => route('publisher.orders.show', $this->order->order->uuid),
            'url_text' => 'View order',
        ];
    }
}
