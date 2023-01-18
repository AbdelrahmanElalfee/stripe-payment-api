<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'api',
    'prefix' => 'payment',
], function ($router) {
    Route::post('charge', [StripePaymentController::class, 'singleCharge']);
    Route::post('customer', [CustomerController::class, 'createStripeCustomer']);
    Route::post('plan', [PlanController::class, 'createStripePlan']);
    Route::post('price', [PriceController::class, 'createStripePrice']);
    Route::post('product', [ProductController::class, 'createStripeProduct']);
    Route::post('subscription', [SubscriptionController::class, 'createStripeSubscription']);
    Route::post('token', [TokenController::class, 'createStripeToken']);
});
