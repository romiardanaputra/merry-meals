<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Session;
use Stripe;

class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('components.stripe' , ['title_page' => 'Donation Form']);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Stripe\Customer::create(array(
            "email" => $request->donatorEmail,
            "name" => $request->donatorName,
            "source" => $request->stripeToken
        ));

        Stripe\Charge::create ([

                "amount" => $request->amount * 100,
                "currency" => "usd",
                // "source" => $request->stripeToken,
                "customer" => $customer->id,
                "description" => $request->description
        ]);



        Donation::create([
            'donatorName' => $request->donatorName,
            'donatorAddress' => $request->donatorAddress,
            'donatorEmail' => $request->donatorEmail,
            'donatorPhone' => $request->donatorPhone,
            'donationAmount' =>$request->amount
        ]);


        Session::flash('success', 'Payment successful!');

        return back();
    }
}
