<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.list_user', [
            'data_users' => User::all(),
            'title_page' => 'User List',
            'dashboard_info' => 'Users Data',
        ]);
    }

    public function create()
    {
        return view('admin.create_user', [
            'title_page' => 'Sign Up'
        ]);
    }

    public function store(UserRequest $req)
    {
        $validated_data = $req->validated();
        $validated_data['password'] = Hash::make($validated_data['password']);
        User::create($validated_data);
        return to_route('admin.index');
    }

    public function edit(User $user)
    {
        $userID = User::find($user->id);
        return view('admin.edit_user', [
            'title' => 'Edit User',
            'user' => $userID,
        ]);
    }

    public function update(UpdateUserRequest $req, User $user)
    {
        $users_data = $req->validated();
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
