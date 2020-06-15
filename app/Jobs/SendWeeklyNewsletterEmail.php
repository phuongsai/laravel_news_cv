<?php

namespace App\Jobs;

use App\Mail\WeeklyNewsletterEmail;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendWeeklyNewsletterEmail implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $subscriber;

    /**
     * Create a new job instance.
     */
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Top 10 Posts of last week
        $posts = Post::lastDays(7)->approved()->published()
            ->orderBy('view_count', 'desc')
            ->take(10)->get();

        // If there are new posts in last week
        if (count($posts) > 0) {
            // Generate Email
            $email = new WeeklyNewsletterEmail($this->subscriber, $posts);
            // Send Email
            Mail::to($this->subscriber->email)->send($email);
        }
    }
}
