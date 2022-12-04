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
            'title_page' => 'Sign Up',
            'dashboard_info' => 'Create a New User',
        ]);
    }

    public function store(UserRequest $req)
    {
        $validated_data = $req->validated();
        $validated_data['password'] = Hash::make($validated_data['password']);
        User::create($validated_data);
        return to_route('admin.index');
    }

    public function edit($id)
    {
        return view('admin.edit_user', [
            'title_page' => 'Edit User',
            'user' => User::find($id),
            'dashboard_info' => 'Edit User'
        ]);
    }

    public function update(UpdateUserRequest $req, $id)
    {
        $users_data = $req->validated();
        User::where('id', $id)->update($users_data);
        return to_route('admin.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
}
