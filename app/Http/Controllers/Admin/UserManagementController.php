<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Donation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserLocation;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Controllers\User\RegisterController;

class UserManagementController extends Controller
{
    public function index()
    {
        return view('admin.UserList', [
            'data_users' => User::all(),
            'title_page' => 'User List',
            'dashboard_info' => 'Users Data',
        ]);
    }

    public function create()
    {
        return view('admin.userCreate', [
            'title_page' => 'Sign Up',
            'dashboard_info' => 'Create a New User',
        ]);
    }

    public function store(UserCreateRequest $request, UserLocation $reqLoc)
    {
        $users = $request->validated();
        $users['password'] = Hash::make($request['password']);
        $dataUsers = User::create($users);
        RegisterController::userLocation($dataUsers, $request, $reqLoc);
        return to_route('admin.index');
    }

    public function edit($id)
    {
        return view('admin.userEdit
        ', [
            'title_page' => 'Edit User',
            'user' => User::find($id),
            'dashboard_info' => 'Edit User'
        ]);
    }

    public function update(UserUpdateRequest $req, $id)
    {
        $users_data = $req->validated();
        User::where('id', $id)->update($users_data);
        return to_route('admin.index');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back();
    }

    public function donatorList(){
        return view('admin.donationList',[
            'title_page' => 'donator list',
            'dashboard_info' => 'all list donator',
            'donators' => Donation::all(),
        ]);
    }
}
