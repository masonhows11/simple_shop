<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ticket;
use Illuminate\Http\Request;

class AdminReplyController extends Controller
{
    public function response(ticket $ticket, Request $request)
    {
        $request->validate([
            'message' => ['string','min:5','max:1000']
        ]);

        dd($ticket, $request);
    }
}
