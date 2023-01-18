<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Token;
use Stripe\Stripe;

class TokenController extends Controller
{
    public function createStripeToken(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            $token = Token::create(array(
                'card' => [
                    'number' => $request->number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ));
            return response()->json($token);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
