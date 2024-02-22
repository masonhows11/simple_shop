<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerificationEmailListener
{
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
