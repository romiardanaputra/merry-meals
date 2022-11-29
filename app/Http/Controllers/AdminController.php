<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'users' => User::all(),
            'title_page' => 'User List',
            'dashboard_info' => 'Users Data',
        ]);
    }

    public function create()
    {
        return view('admin.create', [
            'title_page' => 'Sign Up'
        ]);
    }

    public function store(UserRequest  $request)
    {
        $validated_data = $request->validated();
        $validated_data['password'] = Hash::make($validated_data['password']);
        User::create($validated_data);
        return to_route('admin.index');
    }

    public function edit(User $user)
    {
        $userID = User::find($user->id);
        return view('admin.edit', [
            'title' => 'Edit User',
            'user' => $userID,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $users_data = $request->validated();
        User::where('id', $user->id)->update($users_data);
        return to_route('admin.index');
    }

    public function destroy(User $user)
    {
        $user = User::find($user->id);
        $user->delete();
        return redirect()->back();
    }
}
