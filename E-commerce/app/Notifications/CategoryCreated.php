<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CategoryCreated extends Notification
{
    use Queueable;

    public $category, $admin_name;

    public function __construct($category, $admin_name)
    {
        $this->category = $category;
        $this->admin_name = $admin_name;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "The category {$this->category->name} has been created by the admin {$this->admin_name}",
            'url' => route('admin.categories.show', $this->category->uuid),
            'url_text' => 'View category',
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "The category {$this->category->name} has been created by the admin {$this->admin_name}",
            'url' => route('admin.categories.show', $this->category->uuid),
            'url_text' => 'View category',
        ];
    }
}
