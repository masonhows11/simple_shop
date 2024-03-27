<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Http\Requests\Front\CreateTicketRequest;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //

    public function index()
    {
        return view('front.ticket.index');
    }

    public function create()
    {
        return view('front.ticket.create');
    }

    public function store(CreateTicketRequest $request)
    {

    }
}
