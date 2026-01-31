<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonationController extends Controller
{
     public function index(){
      return view('pages.donation');
    }

    public function create(){
      return view('pages.member.index');
    }
}
