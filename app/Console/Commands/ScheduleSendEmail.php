<?php

namespace App\Console\Commands;

use App\Jobs\SendWeeklyNewsletterEmail;
use App\Listeners\WeeklyNewsletterListener;
use App\Models\Subscriber;
use Illuminate\Console\Command;

class ScheduleSendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending weekly newsletter to the active subscribers';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Subscriber::active()->chunk(100, function ($subscribers) {
            foreach ($subscribers as $key => $subscriber) {
                // Automatic Weekly Newsletter
                event(new WeeklyNewsletterListener($subscriber));
                SendWeeklyNewsletterEmail::dispatch($subscriber);
            }
        });
    }
}
