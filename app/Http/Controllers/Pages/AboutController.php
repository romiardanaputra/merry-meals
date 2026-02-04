<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;

class AboutController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('About Us');
        SEOTools::setDescription('Learn more about Merry Meals, our mission to provide nutritious meals, and the community we serve.');
        SEOTools::opengraph()->setUrl(url('/about'));
        SEOTools::setCanonical(url('/about'));

        return view('features.public.about.index');
    }
}
