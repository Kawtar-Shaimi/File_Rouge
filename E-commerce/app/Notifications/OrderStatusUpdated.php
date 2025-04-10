<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusUpdated extends Notification
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
            'message' => "Your order {$this->order->order_number} status has been updated to {$this->order->status}",
            'url' => route('client.orders.show', $this->order->uuid),
            'url_text' => 'View order',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Your order {$this->order->order_number} status has been updated to {$this->order->status}",
            'url' => route('client.orders.show', $this->order->uuid),
            'url_text' => 'View order',
        ];
    }
}
