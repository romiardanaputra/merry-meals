<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;

class IndexController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Home');
        SEOTools::setDescription('Merry Meals - Providing nutritious meals and compassionate care to those who need it most. Meals on wheels service for the community.');
        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::setCanonical(url('/'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@MerryMeals');

        return view('features.public.home.index');
    }
}
