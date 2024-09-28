<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request){

        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'You should be logged in'
            ],401);
        }


        $order = Order::create([
            'user_id'=>$user->id,
        ]);

        return response()->json(['message' => 'Order created successfully'],200);
    }
}
