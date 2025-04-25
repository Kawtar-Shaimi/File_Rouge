<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCancelled extends Notification
{
    public $order, $reason;

    public function __construct($order, $reason)
    {
        $this->order = $order;
        $this->reason = $reason;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "Your order {$this->order->order_number} has been canceled due to: {$this->reason}",
            'url' => route('client.order.show', $this->order->uuid),
            'url_text' => 'View order',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Your order {$this->order->order_number} has been canceled due to: {$this->reason}",
            'url' => route('client.order.show', $this->order->uuid),
            'url_text' => 'View order',
        ];
    }
}
