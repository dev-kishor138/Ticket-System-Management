<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tickets;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get(){
        $tickets = Tickets::with('bus', 'travelRoute')->latest()->get();
        return response()->json([
            'status' => 200,
            'tickets' => $tickets
        ]);
    }
}
