<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class PublicPageController extends Controller
{
    public function index()
    {
        return view('components.landing', [
            'title_page' => 'Landing',
        ]);
    }

    public function contactIndex()
    {
        return view('components.contact', [
            'title_page' => 'Contact'
        ]);
    }
    public function termIndex()
    {
        return view('components.term', [
            'title_page' => 'Term',
        ]);
    }
    public function aboutIndex()
    {
        return view('components.about', [
            'title_page' => 'About'
        ]);
    }
    public function donationIndex()
    {
        return view('components.donate', [
            'title_page' => 'Donation',
        ]);
    }
    public function mealDetailIndex()
    {
        return view('components.menu_detail', [
            'title_page' => 'meal detail',
        ]);
    }
}
