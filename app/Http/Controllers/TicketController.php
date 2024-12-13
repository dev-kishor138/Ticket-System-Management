<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index()
    {
        $buses = Bus::latest()->get();
        return view('backend.ticket.index', compact('buses'));
    }
    public function view()
    {
        $tickets = Tickets::with('bus')->latest()->get();
        return response()->json([
            'status' => 200,
            'tickets' => $tickets
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bus_id' => 'integer|required|between:0,99999999999',
            'price' => 'required|numeric|between:0,9999999999999.99',
            'time' => 'required',
            'available_seats' => 'required|integer|between:0,99.99',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '500',
                'error' => $validator->messages()
            ]);
        }
        $ticket = new Tickets;
        $ticket->bus_id = $request->bus_id;
        $ticket->price = $request->price;
        $ticket->time = $request->time;
        $ticket->available_seats = $request->available_seats;
        $ticket->save();

        return response()->json([
            'status' => 200,
            'message' => 'ticket Saved Successfully',
        ]);
    }

    public function edit($id)
    {
        $ticket = Tickets::findOrFail($id);
        return response()->json([
            'status' => 200,
            'ticket' => $ticket
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'bus_id' => 'integer|required|between:0,99999999999',
            'price' => 'required|numeric|between:0,9999999999999.99',
            'time' => 'required',
            'available_seats' => 'required|integer|between:0,99.99',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '500',
                'error' => $validator->messages()
            ]);
        }
        $ticket = new Tickets;
        $ticket->bus_id = $request->bus_id;
        $ticket->price = $request->price;
        $ticket->time = $request->time;
        $ticket->available_seats = $request->available_seats;
        $ticket->save();

        return response()->json([
            'status' => 200,
            'message' => 'ticket Update Successfully',
        ]);
    }

    public function delete($id)
    {
        $ticket = Tickets::findOrFail($id);
        $ticket->delete();
        return response()->json([
            'status' => 200,
            'message' => 'ticket Deleted Successfully',
        ]);
    }
}
