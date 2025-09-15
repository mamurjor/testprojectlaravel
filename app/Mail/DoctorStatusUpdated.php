<?php

namespace App\Mail;

use App\Models\Doctor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DoctorStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $doctor;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct(Doctor $doctor, $status)
    {
        $this->doctor = $doctor;
        $this->status = $status;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Profile Status Has Been Updated')
                    ->markdown('emails.doctor.status')
                    ->with([
                        'doctorName' => $this->doctor->name,
                        'status' => ucfirst($this->status),
                    ]);
    }
}
