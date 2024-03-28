<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ticket;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    //

    public function index()
    {
        $tickets = auth()->user()->tickets;
        return view('admin.tickets.index', ['tickets' => $tickets]);

    }

    public function show(ticket $ticket)
    {
        dd($ticket);
        return view('admin.tickets.show');
    }

    public function newTickets()
    {

    }


    public function openTickets()
    {

    }

    public function closedTickets()
    {

    }
}
