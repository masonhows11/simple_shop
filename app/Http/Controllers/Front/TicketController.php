<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function create()
    {
        return view('front.ticket.create');
    }


    public function store(Request $request)
    {

    }
}
