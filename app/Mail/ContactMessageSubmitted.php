<?php
// app/Mail/ContactMessageSubmitted.php
namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageSubmitted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public ContactMessage $messageModel) {}

    public function build()
    {
        return $this->subject('New Contact Message #'.$this->messageModel->id)
                    ->markdown('emails.contact.submitted', [
                        'm' => $this->messageModel,
                    ]);
    }
}
