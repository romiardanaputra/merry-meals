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
        return view('components.donation_form' , ['title_page' => 'Donation Form']);
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
            "source" => $request->stripeToken,
            "email" => $request->donatorEmail,
            // "address"=> $request->address,
            "name" => $request->donatorName,
            "phone" => $request->donatorPhone,
        ));

        // dd($customer);

        Stripe\Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => "usd",
                // "source" => $request->stripeToken,
                "description" => $request->description,
                "customer" => $customer->id,
        ]);



        Donation::create([
            'donatorName' => $request->donatorName,
            // 'address' => $request->address,
            'donatorEmail' => $request->donatorEmail,
            'donatorPhone' => $request->donatorPhone,
            'donationAmount' =>$request->amount,
            'description' => $request->description
        ]);


        Session::flash('success', 'Payment successful!');

        return back();
    }
}
