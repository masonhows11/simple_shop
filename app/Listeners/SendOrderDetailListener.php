<?php

namespace App\Listeners;

use App\Events\OrderRegisteredEvent;
use App\Mail\OrderDetailEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderDetailListener
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
     * @param OrderRegisteredEvent $event
     */
    public function handle(OrderRegisteredEvent $event): void
    {
        //
        Mail::to($this)->send(new OrderDetailEmail($event->order->user));
    }
}
