<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:web');
        $this->middleware('guest:admin');
    }

    //
    public function index()
    {
        return view('admin.index');
    }
}
