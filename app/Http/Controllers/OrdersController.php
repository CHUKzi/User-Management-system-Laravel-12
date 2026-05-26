<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    public function index()
    {

    }

    public function create(Request $request)
    {
        Log::info($request->all());
        return response()->json([
            /*'status' => 'success',*/
            /*'data' => $request->all(),
            'message' => 'tested successfully',*/
            'status' => 200,
            "waybill_no" => "10000001"
        ]);
    }
}
