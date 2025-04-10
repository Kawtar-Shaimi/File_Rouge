<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminOrderCanceled extends Notification
{
    use Queueable;

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
            'message' => "The order {$this->order->order_number} has been canceled due to: {$this->reason}",
            'url' => route('admin.orders.show', $this->order->uuid),
            'url_text' => 'View order',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "The order {$this->order->order_number} has been canceled due to: {$this->reason}",
            'url' => route('admin.orders.show', $this->order->uuid),
            'url_text' => 'View order',
        ];
    }
}
