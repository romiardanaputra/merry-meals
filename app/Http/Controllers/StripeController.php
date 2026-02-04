<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\RegisterController;
use App\Http\Requests\User\UserLocation;
use App\Models\Donation;
use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Stripe;

class StripeController extends Controller
{
    public function stripe()
    {
        return view('components.donation_form', ['title_page' => 'Donation Form']);
    }

    public function stripePost(Request $request, UserLocation $reqLoc)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Stripe\Customer::create([
            'source' => $request->stripeToken,
            'email' => $request->donatorEmail,
            'name' => $request->donatorName,
            'phone' => $request->donatorPhone,
        ]);

        Stripe\Charge::create([
            'amount' => $request->amount * 100,
            'currency' => 'usd',
            'description' => $request->description,
            'customer' => $customer->id,
        ]);

        Donation::create([
            'donatorName' => $request->donatorName,
            'donatorEmail' => $request->donatorEmail,
            'donatorPhone' => $request->donatorPhone,
            'donationAmount' => $request->amount,
            'description' => $request->description,
        ]);

        if (UserModel::where('email', '=', $request->donatorEmail)->exists()) {
            Session::flash('success', 'Payment successful!');
        } else {
            $dataDonator = UserModel::create([
                'fullName' => $request->donatorName,
                'username' => $request->donatorName,
                'email' => $request->donatorEmail,
                'phoneNumber' => $request->donatorPhone,
                'address' => 'not assigned',
                'password' => Hash::make('asdasd123'),
                'role' => 'donor',
                'age' => 0,
                'ip_id' => 'not assigned',
            ]);
            RegisterController::userLocation($dataDonator, $request, $reqLoc);
            Session::flash('success', 'Payment successful. we have created an account for you, you can use your email and [asdasd123] as your password to login to our website!');
        }

        return back();
    }
}
