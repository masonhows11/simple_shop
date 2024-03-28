<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Http\Requests\Front\CreateTicketRequest;
use App\Models\ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //

    public function index()
    {
        $tickets = auth()->user()->tickets()->get();
       // dd($tickets);
        return view('front.ticket.index',['tickets' => $tickets]);
    }

    public function create()
    {
        return view('front.ticket.create');
    }

    public function store(CreateTicketRequest $request)
    {
        //// create() this is create() method
        //// like this Ticket::create([]);
        auth()->user()->tickets()->create(
            $request->all() + ['file_path' => $this->uploadFile($request)]
        );
        session()->flash('success',__('messages.new_successfully_sent'));
        return redirect()->route('ticket.index');
    }


    private function uploadFile($request)
    {
        return $request->hasFile('file') ? $request->file->store('public') : null;
    }


    public function show(ticket $ticket)
    {
        return view('front.ticket.show',['ticket'=>$ticket]);
    }


    public function response(ticket $ticket, Request $request)
    {
        // dd(auth()->user());
       // dd($ticket,$request);
        $request->validate([
            'message' => ['string','min:5','max:1000']
        ]);

        auth()->user()->replies()->create([
            'message' => $request->message,
            'ticket_id' => $ticket->id,
        ]);

        return redirect()->back();
    }
}
