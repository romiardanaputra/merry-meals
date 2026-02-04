<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;

class BlogController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Blog');
        SEOTools::setDescription('Stay updated with the latest news, stories, and updates from the Merry Meals community.');
        SEOTools::opengraph()->setUrl(url('/blog'));
        SEOTools::setCanonical(url('/blog'));

        return view('features.public.blog.index');
    }
}
