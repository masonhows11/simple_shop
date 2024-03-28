<?php

namespace App\Http\Controllers\Admin;

use App\Events\ReplyCreatedEvent;
use App\Http\Controllers\Controller;
use App\Models\ticket;
use Illuminate\Http\Request;

class AdminReplyController extends Controller
{
    public function response(ticket $ticket, Request $request)
    {
        $request->validate([
            'message' => ['string', 'min:5', 'max:1000']
        ]);


        $reply = auth()->user()->replies()->create([
            'message' => $request->message,
            'ticket_id' => $ticket->id,
        ]);

        event(new ReplyCreatedEvent($reply, auth()->user()));

        return redirect()->back();
    }
}
