<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class StripePaymentController extends Controller
{
    public function singleCharge(Request $request)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $token = (new TokenController)->createStripeToken($request);
            $customer = (new CustomerController)->createStripeCustomer($request, $token);
            Charge::create(array(
                'customer' => $customer,
                'amount' => $request->amount,
                'currency' => 'aed'
            ));
            return response()->json(['process' => 'Succeeded']);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
