<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {

        $q = trim($request->get('q',''));
        $subs = NewsletterSubscriber::query()
            ->when($q, fn($qq)=>$qq->where('email','like',"%{$q}%"))
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('emails.admin.subscribers.index', compact('subs','q'));
    }

    public function destroy($id)
    {
        $sub = NewsletterSubscriber::findOrFail($id);
        $sub->delete();
        return back()->with('ok','Subscriber deleted');
    }

    public function markVerified($id)
    {
        $sub = NewsletterSubscriber::findOrFail($id);
        $sub->verified_at = now();
        $sub->verify_token = null;
        $sub->unsubscribed_at = null;
        $sub->save();
        return back()->with('ok','Marked as verified');
    }

    public function exportCsv(): StreamedResponse
    {
        $filename = 'subscribers_'.now()->format('Y-m-d_His').'.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['id','email','verified_at','unsubscribed_at','created_at']);
            NewsletterSubscriber::orderBy('id')->chunkById(1000, function ($rows) use ($out) {
                foreach ($rows as $r) {
                    fputcsv($out, [
                        $r->id,
                        $r->email,
                        optional($r->verified_at)->toDateTimeString(),
                        optional($r->unsubscribed_at)->toDateTimeString(),
                        optional($r->created_at)->toDateTimeString(),
                    ]);
                }
            });
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }
}
