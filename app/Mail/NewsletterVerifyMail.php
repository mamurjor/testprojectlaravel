<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\NewsletterSubscriber;

class NewsletterVerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public NewsletterSubscriber $subscriber) {}

    public function build()
    {
        $url = url('/newsletter/verify?token=' . $this->subscriber->verify_token);
        return $this->subject('Confirm your subscription')
            ->view('emails.newsletter-verify', ['url' => $url, 'email' => $this->subscriber->email]);
    }
}
