<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TravelRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TravelRouteController extends Controller
{
    public function index()
    {
        return view('backend.travel-route.index');
    }
    public function view()
    {
        $travelRoutes = TravelRoute::latest()->get();
        return response()->json([
            'status' => 200,
            'travelRoutes' => $travelRoutes
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required|string|max:99',
            'to' => 'required|string|max:99',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '500',
                'error' => $validator->messages()
            ]);
        }
        $travelRoute = new TravelRoute;
        $travelRoute->travel_name = $request->from . ' to ' . $request->to;
        $travelRoute->from = $request->from;
        $travelRoute->to = $request->to;
        $travelRoute->save();

        return response()->json([
            'status' => 200,
            'message' => 'Travel Saved Successfully',
        ]);
    }

    public function edit($id)
    {
        $travelRoute = TravelRoute::findOrFail($id);
        return response()->json([
            'status' => 200,
            'travelRoute' => $travelRoute
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required|string|max:99',
            'to' => 'required|string|max:99',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '500',
                'error' => $validator->messages()
            ]);
        }
        $travelRoute = TravelRoute::findOrFail($id);
        $travelRoute->travel_name = $request->from . ' to ' . $request->to;
        $travelRoute->from = $request->from;
        $travelRoute->to = $request->to;
        $travelRoute->save();

        return response()->json([
            'status' => 200,
            'message' => 'Travel Update Successfully',
        ]);
    }

    public function delete($id)
    {
        $travelRoute = TravelRoute::findOrFail($id);
        $travelRoute->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Travel Deleted Successfully',
        ]);
    }
}
