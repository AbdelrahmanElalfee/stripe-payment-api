<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Plan;
use Stripe\Stripe;

class PlanController extends Controller
{
    public function createStripePlan(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            $plan = Plan::create([
                'amount' => $request->price,
                'currency' => 'aed',
                'interval' => $request->interval,
                'product' => $request->id
            ]);
            return response()->json($plan);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
