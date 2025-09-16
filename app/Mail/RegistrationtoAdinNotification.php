<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationtoAdinNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $isAdmin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registration, $isAdmin = false)
    {
        $this->registration = $registration;
        $this->isAdmin = $isAdmin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

            if ($this->isAdmin) {
            return $this->subject('নতুন রেজিস্ট্রেশন হয়েছে')
                        ->view('emails.admin_registration_notification');
        } else {
            return $this->subject('আপনার রেজিস্ট্রেশন সফল হয়েছে')
                        ->view('emails.user_registration_notification');
        }

    }
}
