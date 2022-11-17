<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(){
        return view('components.landing');
    }

    public function showDashboard(){
        return view('components.dashboard_user');
    }
}
