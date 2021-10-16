<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('payments.stripe');
    }

    public function stripePost(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        Charge::create([
            'amount' => 70 * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Test payment via Stripe'
        ]);

        $request->session()->flash('success', 'Payment done successfully!');

        return back();
    }
}
