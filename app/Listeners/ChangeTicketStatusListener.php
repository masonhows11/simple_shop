<?php

namespace App\Listeners;

use App\Events\ReplyCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeTicketStatusListener
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
     * @param ReplyCreatedEvent $event
     */
    public function handle(ReplyCreatedEvent $event): void
    {
        //
    }
}
