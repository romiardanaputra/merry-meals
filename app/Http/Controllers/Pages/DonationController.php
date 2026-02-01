<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonationController extends Controller
{
     public function index(){
      return view('features.public.donations.index');
    }

    public function create(){
      return view('features.public.donations.partials.donation-form');
    }
}
