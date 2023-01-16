<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Customer;

class CustomerController extends Controller
{
    public function createStripeCustomer(Request $request, $token)
    {
        $customer = Customer::create(array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->email,
            'source' => $token
        ));

        return $customer->id;
    }
}
