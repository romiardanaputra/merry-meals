<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonationController extends Controller
{
     public function index(){
      return view('features.donation.index');
    }

    public function create(){
      return view('features.donation.partials.donation-form');
    }
}
