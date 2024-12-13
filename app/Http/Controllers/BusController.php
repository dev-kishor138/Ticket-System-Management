<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusController extends Controller
{
    public function index()
    {
        return view('backend.bus.index');
    }
    public function view()
    {
        $buses = Bus::latest()->get();
        return response()->json([
            'status' => 200,
            'buses' => $buses
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|max:99',
            'bus_number' => 'string|max:99',
            'total_seats' => 'required|integer|between:0,99.99',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '500',
                'error' => $validator->messages()
            ]);
        }
        $bus = new Bus;
        $bus->name = $request->name;
        $bus->bus_number = $request->bus_number;
        $bus->total_seats = $request->total_seats;
        $bus->save();

        return response()->json([
            'status' => 200,
            'message' => 'Bus Saved Successfully',
        ]);
    }

    public function edit($id)
    {
        $bus = Bus::findOrFail($id);
        return response()->json([
            'status' => 200,
            'bus' => $bus
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|max:99',
            'bus_number' => 'string|max:99',
            'total_seats' => 'required|integer|between:0,99.99',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '500',
                'error' => $validator->messages()
            ]);
        }
        $bus = Bus::findOrFail($id);
        $bus->name = $request->name;
        $bus->bus_number = $request->bus_number;
        $bus->total_seats = $request->total_seats;
        $bus->save();

        return response()->json([
            'status' => 200,
            'message' => 'Bus Update Successfully',
        ]);
    }

    public function delete($id)
    {
        $bus = Bus::findOrFail($id);
        $bus->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Bus Deleted Successfully',
        ]);
    }
}
