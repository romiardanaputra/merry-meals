<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SeoController extends Controller
{
    /**
     * Generate dynamic sitemap.xml
     */
    public function sitemap(): Response
    {
        $urls = [
            ['url' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => url('/about'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/contact'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/term'), 'priority' => '0.5', 'changefreq' => 'monthly'],
        ];

        // Add public meals if applicable (if they have public landing pages)
        // For now, let's just stick to static pages as most meals are behind auth

        $xml = view('seo.sitemap', compact('urls'))->render();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }
}
