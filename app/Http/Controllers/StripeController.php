<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\User as UserModel;
use Illuminate\Foundation\Auth\User;

use Illuminate\Http\Request;
use Session;
use Stripe;
use Illuminate\Support\Facades\Hash;

class StripeController extends Controller
{
    public function stripe()
    {
        return view('components.donation_form' , ['title_page' => 'Donation Form']);
    }

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

        if (UserModel::where('email', '=', $request->donatorEmail)->exists()) {
            Session::flash('success', 'Payment successful!');
        } else {
            UserModel::create([
                'fullName'=> $request->donatorName,
                'username' => $request->donatorName,
                'email'=> $request->donatorEmail,
                'phoneNumber'=> $request->donatorPhone,
                'address' => 'not assigned',
                'password' => Hash::make("asdasd123"),
                'role' => "donors",
                'age' => 0,
                'ip_id' => "not assigned"
            ]);
            Session::flash('success', 'Payment successful. we have created an account for you, you can use your email and asdasd123 as your password to login to our website!');
        }



        return back();
    }
}
