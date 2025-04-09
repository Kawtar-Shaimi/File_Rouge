<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CategoryCreated extends Mailable
{
    public $user, $category, $admin_name;

    public function __construct($user, $category, $admin_name)
    {
        $this->user = $user;
        $this->category = $category;
        $this->admin_name = $admin_name;
    }

    public function build()
    {
        return $this->view('emails.admin.categories.category-created')
            ->subject('Category Created')
            ->with([
                'user' => $this->user,
                'category' => $this->category,
                'admin_name' => $this->admin_name
            ]);
    }
}
