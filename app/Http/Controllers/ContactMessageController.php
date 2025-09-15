<?php
// app/Http/Controllers/ContactMessageController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactMessage;
use App\Mail\ContactMessageSubmitted;

class ContactMessageController extends Controller
{
    // Admin list
    public function index(Request $request)
    {
        $q = $request->get('q');
        $messages = ContactMessage::when($q, function($query) use ($q) {
                $query->where('name','like',"%$q%")
                      ->orWhere('email','like',"%$q%")
                      ->orWhere('phone','like',"%$q%");
            })
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.contact_messages.index', compact('messages','q'));
    }

    // Admin single
    public function show(ContactMessage $contactMessage)
    {
        if (!$contactMessage->is_read) {
            $contactMessage->update(['is_read' => true]);
        }
        return view('admin.contact_messages.show', compact('contactMessage'));
    }

    public function markRead(ContactMessage $contactMessage)
    {
        $contactMessage->update(['is_read' => true]);
        return back()->with('success','Marked as read.');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact.index')->with('success','Deleted.');
    }

    // Public AJAX store
   public function store(Request $request)
{
    try {
        // 1) Validate
        $data = $request->validate([
            'name'    => 'required|string|max:120',
            'email'   => 'nullable|email|max:180',
            'phone'   => 'nullable|string|max:40',
            'message' => 'required|string|min:5',
            'g-recaptcha-response' => 'nullable|string',
        ]);

        // 2) reCAPTCHA (লোকালে স্কিপ / প্রোডে ভেরিফাই)
        $site   = config('services.recaptcha.site_key');
        $secret = config('services.recaptcha.secret_key');
        $ver    = config('services.recaptcha.version', 'v3');

        if ($site && $secret && !app()->environment('local')) {
            $token = $request->input('g-recaptcha-response');
            if (!$token) {
                return response()->json(['ok'=>false,'message'=>'reCAPTCHA token missing.'], 422);
            }

            try {
                $resp = Http::timeout(8)->asForm()->post(
                    'https://www.google.com/recaptcha/api/siteverify',
                    ['secret'=>$secret,'response'=>$token,'remoteip'=>$request->ip()]
                )->json();
            } catch (\Throwable $e) {
                Log::warning('reCAPTCHA HTTP failed: '.$e->getMessage());
                return response()->json(['ok'=>false,'message'=>'reCAPTCHA verification failed.'], 422);
            }

            $valid = data_get($resp,'success') === true;

            if ($valid && $ver === 'v3') {
                $score  = data_get($resp,'score',0);
                $action = data_get($resp,'action');
                if ($action !== 'contact' || $score < (float)config('services.recaptcha.min_score',0.5)) {
                    $valid = false;
                }
            }

            if (!$valid) {
                return response()->json(['ok'=>false,'message'=>'Failed reCAPTCHA verification.'], 422);
            }
        }

        // 3) Save
        $msg = ContactMessage::create($data);

                        // 4) Notify — সব এনভাইরনমেন্টে মেইল পাঠান
                $adminTo = null;

                // 1) settings টেবিল থেকে (যদি helper থাকে)
                if (function_exists('get_setting')) {
                    $adminTo = get_setting('ADMIN_MAIL');
                }

                // 2) config/mail.php থেকে fallback
                if (!$adminTo) {
                    $adminTo = config('mail.from.address');
                }

                // 3) .env থেকে শেষ fallback
                if (!$adminTo) {
                    $adminTo = env('MAIL_FROM_ADDRESS'); // চূড়ান্ত ব্যাকআপ
                }

                try {
                    Mail::to($adminTo)->send(new \App\Mail\ContactMessageSubmitted($msg));
                } catch (\Throwable $e) {
                    // মেইল ফেল করলে 500 দেওয়ার বদলে নরমালি success রিটার্ন করতে চান?
                    // তাহলে এখানে শুধু লগ করে দিন, ইউজারকে ব্লক করবেন না:
                    \Log::error('Contact mail send failed', ['to' => $adminTo, 'err' => $e->getMessage()]);
                    // চাইলে চাইলে নিচের লাইন আনকমেন্ট করে error রিটার্ন করতে পারেন:
                    // return response()->json(['ok'=>false, 'message'=>'Mail sending failed.'], 500);
                }


        return response()->json(['ok'=>true,'message'=>'Thanks! Your message has been sent.','id'=>$msg->id], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        throw $e; // Laravel নিজেই 422 JSON দেবে (Accept: application/json থাকলে)
    } catch (\Throwable $e) {
        Log::error('Contact store failed', ['ex'=>$e]);
        return response()->json([
            'ok'=>false,
            'message'=>config('app.debug') ? $e->getMessage() : 'Server error. Please try again later.'
        ], 500);
    }
}
}
