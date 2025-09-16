<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationNotification;
use App\Mail\RegistrationtoAdinNotification;


class RegistrationController extends Controller
{
    //
    public function store(Request $request, Event $event)
    {

        // চেক করা হচ্ছে, রেজিস্ট্রেশন পূর্ণ হয়েছে কিনা
        if ($event->registerCount() >= $event->max_registrations) {
            return redirect()->route('event.show', $event->id)->with('error', 'Registration limit reached.');
        }

        // চেক করা হচ্ছে, ইভেন্ট শেষ হয়ে গেছে কিনা
        if ($event->end_date < now()) {
            return redirect()->route('event.show', $event->id)->with('error', 'This event has ended.');
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:registrations,email',
        ]);

// রেজিস্ট্রেশন ডাটা ইনসার্ট করা
$registration = Registration::create([
    'event_id' => $event->id,
    'name' => $request->name,
    'email' => $request->email,
]);

// ইউজারকে মেইল পাঠানো
Mail::to($registration->email)->send(new RegistrationtoAdinNotification($registration, false));

// // এডমিনকে মেইল পাঠানো
// $adminEmail = 'admin@example.com';  // আপনার এডমিনের ইমেইল
// Mail::to($adminEmail)->send(new RegistrationNotification($registration, false));


        return redirect()->route('event.show', $event->id)->with('success', 'Successfully Registered!');
    }
}
