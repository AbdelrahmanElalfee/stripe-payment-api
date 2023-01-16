<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Token;

class TokenController extends Controller
{
    public function createStripeToken(Request $request)
    {
        $token = Token::create(array(
            'card' => [
                'number' => $request->number,
                'exp_month' => $request->exp_month,
                'exp_year' => $request->exp_year,
                'cvc' => $request->cvc,
            ],
        ));

        return $token;
    }
}