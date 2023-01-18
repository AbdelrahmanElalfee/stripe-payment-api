<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Product;

class ProductController extends Controller
{
    public function createStripeProduct(Request $request)
    {
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
