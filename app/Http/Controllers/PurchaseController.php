<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Tickets;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'first_series' => 'nullable|string',
            'second_series' => 'nullable|string',
            'third_series' => 'nullable|string',
            'fourth_series' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'error' => $validator->messages(),
            ]);
        }


        $purchase = new Purchase;
        // $purchase->user_id = $request->id;
        $purchase->ticket_id = $request->id;
        $purchase->purchase_date = Carbon::now();
        $purchase->quantity = $request->reach_time;
        $purchase->seat_no = $request->first_series ?? $request->first_series . "1, " . $request->second_series . "2, " . $request->third_series . "3, " . $request->fourth_series . "4";
        $purchase->save();

        return response()->json([
            'status' => 200,
            'message' => 'Purchased Successfully',
        ]);
    }
}
