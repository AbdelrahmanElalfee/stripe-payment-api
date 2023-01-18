<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Customer;
use Stripe\Price;
use Stripe\Subscription;
use Stripe\Stripe;

class SubscriptionController extends Controller
{
    public function createStripeSubscription(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            $subscription = Subscription::create(array(
                'customer' => $request->customer,
                'items' => [
                    ['price' => $request->price],
                ],
            ));
            return response()->json($subscription);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function searchStripeSubscription(Request $request)
    {
        try {
            $subscription = Subscription::search([
                'query' => 'name:\'' . $request->name . '\''
            ]);
            return response()->json($subscription);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function retrieveStripeSubscription($id)
    {
        try {
            $subscription = Subscription::retrieve($id);
            return response()->json($subscription);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function updateStripeSubscription(Request $request, $id)
    {
        try {
            $subscription = Subscription::update([
                $id,
                'customer' => $request->customerId,
                'items' => [
                    ['price' => $request->price],
                ],
            ]);
            return response()->json($subscription);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function allStripeSubscriptions()
    {
        try {
            $subscriptions = Subscription::all();
            return response()->json($subscriptions);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
