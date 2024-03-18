<?php

namespace App\Listeners;

use App\Events\OrderRegisteredEvent;
use App\Mail\OrderDetailEmail;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderDetailListener
{
    /**
     * Create the event listener.
     */
    public Order $order;
    public function __construct(Order $order)
    {
        //
        $this->order = $order;
    }

    /**
     * Handle the event.
     * @param OrderRegisteredEvent $event
     */
    public function handle(OrderRegisteredEvent $event): void
    {
        //
        Mail::to($event->order->user->email)->send(new OrderDetailEmail($event->order));
    }
}
