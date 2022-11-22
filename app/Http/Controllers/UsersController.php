<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
   
    public function index()
    {
        return view('users.index',[
            'users' => User::all(),
        ]);
    }

  
    public function create()
    {
        return view('users.create',[
            'title_page' => 'Sign Up'
        ]);
    }

   
    public function store(Request $request)
    {

        $this->validate($request, [
            'fullName' => ['required', 'max:50'],
            'username' => ['required', 'max:10', 'min:3'],
            'email' => ['required', 'unique:users', 'email:dns,rfc'],
            'phoneNumber' => ['required', 'unique:users', 'numeric'],
            'age' => ['required', 'numeric'],
            'address' => ['required'],
            'password' => ['required', 'min:6'],
            'role' => ['required']
        ]);

        $user = new User();
        $user->fullName = $request->fullName;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phoneNumber = $request->phoneNumber;
        $user->age = $request->age;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;

        $user->save();
        return redirect('/login');
    }

   
    public function show()
    {
   
    }
    
   
    public function edit(User $user)
    {
        $userID = User::find($user->id);
        return view('users.edit',[
            'title' => 'Edit User',
            'user' => $userID,
        ]);
    }

   
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'fullName' => ['required', 'max:50'],
            'username' => ['required', 'max:10', 'min:3'],
            'email' => ['required', 'unique:users', 'email:dns,rfc'],
            'phoneNumber' => ['required', 'unique:users', 'numeric'],
            'age' => ['required', 'numeric'],
            'address' => ['required'],
            'password' => ['required', 'min:6'],
            'role' => ['required']
        ]);

        $user = User::find($user->id);

        $user->fullName = $request->fullName;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phoneNumber = $request->phoneNumber;
        $user->age = $request->age;
        $user->address = $request->address;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->save();
        return redirect()->route('user.index');
    }

    
    public function destroy(User $user)
    {
        $user = User::find($user->id);
        $user->delete();
        return redirect()->back();
    }
}
