<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CategoryDeleted extends Notification
{
    use Queueable;

    public $category_name, $admin_name, $deleted_at;

    public function __construct($category_name, $admin_name)
    {
        $this->category_name = $category_name;
        $this->admin_name = $admin_name;
        $this->deleted_at = now();
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "The category {$this->category_name} has been deleted by the admin {$this->admin_name} at {$this->deleted_at}",
            'url' => route('admin.categories.index'),
            'url_text' => 'View all categories',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "The category {$this->category_name} has been deleted by the admin {$this->admin_name} at {$this->deleted_at}",
            'url' => route('admin.categories.index'),
            'url_text' => 'View all categories',
        ];
    }
}
