<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Geolocation;
use App\Http\Controllers\Controller;

class AdminPageController extends Controller
{
    public function show_list_location(Geolocation $data_users){
        return view('admin.list_user_location',[
            'data_user' => $data_users::all(),
            'title_page' => 'Users Location',
            'dashboard_info' => 'Users Location',
        ]);
    }
}
