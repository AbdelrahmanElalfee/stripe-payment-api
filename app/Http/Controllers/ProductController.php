<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Product;
use Stripe\Stripe;

class ProductController extends Controller
{
    public function createStripeProduct(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            $product = Product::create(array(
                'name' => $request->name,
                'active' => true,
                'description' => $request->description
            ));
            return response()->json($product);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
