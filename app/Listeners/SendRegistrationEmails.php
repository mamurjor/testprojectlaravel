<?php

namespace App\Listeners;

use App\Mail\AdminNewUserNotification;
use App\Mail\WelcomeUserMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendRegistrationEmails implements ShouldQueue
{
    public function handle(Registered $event): void
    {
        $user = $event->user;

        // Admin notification
        $admin = config('mail.admin_address');
        if ($admin) {
            Mail::to($admin)->queue(new AdminNewUserNotification($user));
        }

        // Welcome email to the user
        if (!empty($user->email)) {
            Mail::to($user->email)->queue(new WelcomeUserMail($user));
        }

        // 3) Default email verification (Breeze / Laravel)
        if (method_exists($user, 'sendEmailVerificationNotification')) {
            $user->sendEmailVerificationNotification();
        }
    }
}
