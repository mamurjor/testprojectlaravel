<?php

namespace App\Jobs;

use App\Mail\NoticePublishedMail;
use App\Models\Notice;
use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNoticeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3; // retry
    public function __construct(public Notice $notice) {}

    public function handle(): void
    {
        // কেবল verified ও not-unsubscribed
        $query = NewsletterSubscriber::query()
            ->whereNotNull('verified_at')
            ->whereNull('unsubscribed_at');

        // বড় লিস্ট হলে মেমরি বাঁচাতে chunk ব্যবহার করি
        $query->orderBy('id')->chunkById(500, function ($subs) {
            foreach ($subs as $sub) {
                Mail::to($sub->email)->queue(new NoticePublishedMail($this->notice));
            }
        });
    }
}
