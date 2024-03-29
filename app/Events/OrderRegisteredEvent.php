<?php

namespace App\Events;


//use Illuminate\Broadcasting\Channel;
//use Illuminate\Broadcasting\PresenceChannel;
//use Illuminate\Broadcasting\PrivateChannel;
//use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderRegisteredEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    //    public function broadcastOn(): array
    //    {
    //        return [
    //            new PrivateChannel('channel-name'),
    //        ];
    //    }
}
