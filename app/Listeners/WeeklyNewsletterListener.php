<?php

namespace App\Listeners;

use App\Events\Event;
use App\Models\Subscriber;

class WeeklyNewsletterListener
{
    public $subscriber;

    /**
     * Create the event listener.
     */
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Handle the event.
     */
    public function handle(Event $event)
    {
    }
}
