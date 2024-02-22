<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerificationEmailListener // implements ShouldQueue
{

    // if use implements ShouldQueue
    // send email using queue in background process
    // for run queue
    // we must run php artisan queue:work  --tries=3 as default command queue
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param UserRegisteredEvent $event
     */
    public function handle(UserRegisteredEvent $event): void
    {
        $event->user->sendEmailVerificationNotification();
    }
}
