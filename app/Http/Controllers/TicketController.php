<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Tickets;
use App\Models\TravelRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index()
    {
        $buses = Bus::latest()->get();
        $travelRoutes = TravelRoute::latest()->get();
        return view('backend.ticket.index', compact('buses', 'travelRoutes'));
    }
    public function view()
    {
        $tickets = Tickets::with('bus', 'travelRoute')->latest()->get();
        return response()->json([
            'status' => 200,
            'tickets' => $tickets
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bus_id' => 'integer|required|between:0,99999999999',
            'route_id' => 'integer|required|between:0,99999999999',
            'price' => 'required|numeric|between:0,9999999999999.99',
            'start_time' => 'required|string',
            'reach_time' => 'required|string',
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
        $ticket->route_id = $request->route_id;
        $ticket->price = $request->price;
        $ticket->start_time = $request->start_time;
        $ticket->reach_time = $request->reach_time;
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
            'route_id' => 'integer|required|between:0,99999999999',
            'price' => 'required|numeric|between:0,9999999999999.99',
            'start_time' => 'required|string',
            'reach_time' => 'required|string',
            'available_seats' => 'required|integer|between:0,99.99',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '500',
                'error' => $validator->messages()
            ]);
        }
        $ticket = Tickets::findOrFail($id);
        $ticket->bus_id = $request->bus_id;
        $ticket->route_id = $request->route_id;
        $ticket->price = $request->price;
        $ticket->start_time = $request->start_time;
        $ticket->reach_time = $request->reach_time;
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
