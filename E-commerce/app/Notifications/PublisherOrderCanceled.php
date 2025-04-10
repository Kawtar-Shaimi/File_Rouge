<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PublisherOrderCanceled extends Notification
{
    use Queueable;

    public $order, $reason, $book_name;

    public function __construct($order, $reason, $book_name)
    {
        $this->order = $order;
        $this->reason = $reason;
        $this->book_name = $book_name;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "Your ordered book {$this->book_name} from order {$this->order->order_number} has been canceled by admins due to: {$this->reason}",
            'url' => route('publisher.orders.show', $this->order->uuid),
            'url_text' => 'View order',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Your ordered book {$this->book_name} from order {$this->order->order_number} has been canceled by admins due to: {$this->reason}",
            'url' => route('publisher.orders.show', $this->order->uuid),
            'url_text' => 'View order',
        ];
    }
}
