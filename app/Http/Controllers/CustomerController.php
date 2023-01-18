<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Customer;
use Stripe\Token;

class CustomerController extends Controller
{
    public function createStripeCustomer(Request $request, $token)
    {
        try {
            $customer = Customer::create(array(
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'source' => $token
            ));
            return response()->json($customer);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
