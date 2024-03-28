<?php

namespace App\Events;

use App\Models\Reply;
//use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
//use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
//use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReplyCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $reply;
    public $user;

    /**
     * Create a new event instance.
     * @param Reply $reply
     * @param User $user
     */
    public function __construct(Reply $reply,$user)
    {
        //
        $this->reply = $reply;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
