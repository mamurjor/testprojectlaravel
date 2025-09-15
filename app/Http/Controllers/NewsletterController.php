<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterSubscribeRequest;
use App\Mail\NewsletterVerifyMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    // POST /newsletter/subscribe (AJAX)
    public function subscribe(NewsletterSubscribeRequest $request)
    {
        $email = mb_strtolower(trim($request->input('email')));

        // Already unsubscribed? allow re-subscribe by clearing flag.
        $subscriber = NewsletterSubscriber::where('email', $email)->first();

        if ($subscriber && $subscriber->unsubscribed_at) {
            $subscriber->unsubscribed_at = null;
            $subscriber->verified_at = null;
        }

        if (!$subscriber) {
            $subscriber = NewsletterSubscriber::create([
                'email' => $email,
                'verify_token' => Str::random(40),
            ]);
        } else {
            // Refresh token if not verified yet
            if (!$subscriber->verified_at) {
                $subscriber->verify_token = Str::random(40);
            }
        }

        $subscriber->save();

        // Send verification email
        Mail::to($subscriber->email)->send(new NewsletterVerifyMail($subscriber));

        return response()->json([
            'status'  => 'ok',
            'message' => 'Check your inbox to confirm subscription.',
        ], 200);
    }

    // GET /newsletter/verify?token=...
    public function verify(Request $request)
    {
        $token = $request->query('token');
        $subscriber = NewsletterSubscriber::where('verify_token', $token)->first();

        if (!$subscriber) {
            return view('newsletter.verify-result', [
                'title' => 'Invalid or expired link',
                'ok'    => false,
            ]);
        }

        $subscriber->verified_at = now();
        $subscriber->verify_token = null;
        $subscriber->save();

        return view('newsletter.verify-result', [
            'title' => 'Subscription confirmed!',
            'ok'    => true,
        ]);
    }

    // POST /newsletter/unsubscribe (AJAX or link)
    public function unsubscribe(Request $request)
    {
        $request->validate(['email' => ['required','email']]);

        $subscriber = NewsletterSubscriber::where('email', $request->input('email'))->first();

        if (!$subscriber) {
            return response()->json(['status'=>'ok','message'=>'You are not subscribed.'], 200);
        }

        $subscriber->unsubscribed_at = now();
        $subscriber->save();

        return response()->json(['status'=>'ok','message'=>'You have been unsubscribed.'], 200);
    }
}
