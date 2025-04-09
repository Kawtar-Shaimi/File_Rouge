<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CategoryDeleted extends Mailable
{
    public $user, $category_name, $admin_name, $deleted_at;

    public function __construct($user, $category_name, $admin_name)
    {
        $this->user = $user;
        $this->category_name = $category_name;
        $this->admin_name = $admin_name;
        $this->deleted_at = now();
    }

    public function build()
    {
        return $this->view('emails.admin.categories.category-deleted')
            ->subject('Category Deleted')
            ->with([
                'user' => $this->user,
                'category_name' => $this->category_name,
                'admin_name' => $this->admin_name,
                'deleted_at' => $this->deleted_at
            ]);
    }
}
