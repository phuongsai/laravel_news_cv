<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeeklyNewsletterEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $subscriber;
    protected $posts;

    /**
     * Create a new message instance.
     */
    public function __construct(Subscriber $subscriber, Post $posts)
    {
        $this->subscriber = $subscriber;
        $this->posts = $posts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'testmailcgh@gmail.com';
        $subject = 'Weekly Newsletter Email!';
        $name = 'Laravel News';

        return $this->view('vendor.mails.html.message')
            ->from($address, $name)
            ->subject($subject)
            ->with('posts', $this->posts);
    }
}
