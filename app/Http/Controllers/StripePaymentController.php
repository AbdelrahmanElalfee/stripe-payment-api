<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Session;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Token;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        $user = User::findOrFail(1);
        $intent = $user->createSetupIntent();
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
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
