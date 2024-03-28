<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    //

    public function index()
    {
        $tickets = auth()->user()->tickets;
        return view('admin.tickets.index', ['tickets' => $tickets]);

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
