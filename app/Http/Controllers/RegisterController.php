<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    //view for register
    public function index()
    {
        return view('components.register', [
            "name_content" => "registration",
            "title" => "Sign Up"
        ]);
    }

    public function store_data(Request $registration_request)
    {
        $date_validate = $registration_request->validate([
            'first_name' => 'bail | required | max:100 | min:3',
            'last_name' => 'bail | required | max:100 | min:3',
            'username' => 'bail | required | max:100 | min:3 | unique:users',   
            'email_user' => 'bail | required | max:100 | email:dns,rfc | unique:users',
            'password' => 'bail | required | max:100 | min:6',
            'phone_number' => 'bail | required | min_digits:10 | max_digits:14 | unique:users',
            'role' => 'bail | required',
            'address' => 'bail | required'
        ]);

        // encrypt password 
        $date_validate['password'] = bcrypt($date_validate['password']);

        // store data to database
        User::create($date_validate);

        //redirect to login page
        return redirect('/login')->with('success', 'registration success please login!');
    }
}
