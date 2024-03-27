<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //

    public function index()
    {
        return view('front.ticket.index');
    }

    public function create(Request $request)
    {
        return view('front.ticket.create');
    }

    public function store(Request $request)
    {
        dd($request);
    }
}
