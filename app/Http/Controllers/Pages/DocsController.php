<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocsController extends Controller
{
    /**
     * Display the documentation page.
     */
    public function index()
    {
        $links = [
            'overview' => 'Overview',
            'tech-stack' => 'Tech Stack',
            'architecture' => 'Architecture',
            'database' => 'Database Schema',
            'colors' => 'Color Palette',
            'api' => 'API & Routes',
            'installation' => 'Installation',
        ];

        return view('features.docs.index', compact('links'));
    }
}
