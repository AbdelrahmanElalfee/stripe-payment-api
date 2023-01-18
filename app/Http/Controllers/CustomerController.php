<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Customer;
use Stripe\Stripe;

class CustomerController extends Controller
{
    public function createStripeCustomer(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            $customer = Customer::create(array(
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'source' => $request->token
            ));
            return response()->json($customer);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
