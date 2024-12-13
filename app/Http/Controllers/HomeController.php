<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tickets;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $tickets = Tickets::latest()->get();
        return view('frontend.home', compact('tickets'));
    }
}
