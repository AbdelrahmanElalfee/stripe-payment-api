<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Price;

class PriceController extends Controller
{
    public function createStripePrice(Request $request, $id)
    {
        try {
            $price = Price::create(array(
                'unit_amount' => $request->amount,
                'currency' => $request->currency,
                'recurring' => ['interval' => $request->interval],
                'product' => $request->id
            ));
            return response()->json($price);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
