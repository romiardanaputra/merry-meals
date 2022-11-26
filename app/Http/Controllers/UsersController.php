<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index()
    {
        return view('users.index', [
            'users' => User::all(),
        ]);
    }

    public function create()
    {
        return view('users.create', [
            'title_page' => 'Sign Up'
        ]);
    }

    public function store(UserRequest  $request)
    {
        $validated_data = $request->validated();
        $validated_data['password'] = Hash::make($validated_data['password']);
        User::create($validated_data);
        return to_route('user.index');
    }

    public function edit(User $user)
    {
        $userID = User::find($user->id);
        return view('users.edit', [
            'title' => 'Edit User',
            'user' => $userID,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $users_data = $request->validated();
        User::where('id', $user->id)->update($users_data);
        return to_route('user.index');
    }

    public function destroy(User $user)
    {
        $user = User::find($user->id);
        $user->delete();
        return redirect()->back();
    }
}
