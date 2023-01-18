<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Plan;

class PlanController extends Controller
{
    public function createStripePlan(Request $request)
    {
        try {
            $plan = Plan::create([
                'amount' => $request->price,
                'currency' => 'aed',
                'interval' => $request->interval,
                'product' => $request->productId
            ]);
            return response()->json($plan);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
