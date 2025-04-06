<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVerified extends Mailable
{
    public $user, $guard;

    public function __construct($user, $guard)
    {
        $this->user = $user;
        $this->guard = $guard;
    }

    public function build()
    {
        return $this->view('emails.email-verified')
            ->subject('Email Verified Successfully')
            ->with([
                'user' => $this->user,
                'guard' => $this->guard,
            ]);
    }
}