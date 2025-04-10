<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClientOrderBookCanceled extends Notification
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
            'message' => "The book {$this->book_name} from your order {$this->order->order_number} has been canceled due to: {$this->reason}",
            'url' => route('client.orders.show', $this->order->uuid),
            'url_text' => 'View order',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "The book {$this->book_name} from your order {$this->order->order_number} has been canceled due to: {$this->reason}",
            'url' => route('client.orders.show', $this->order->uuid),
            'url_text' => 'View order',
        ];
    }
}
