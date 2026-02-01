<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('features.public.contact.index');
    }

    public function store(Request $request)
    {
        // Simple Honeypot Check
        if ($request->filled('b_name')) {
            return response()->json(['status' => 'success'], 200);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category' => 'required|string|in:support,partnership,donation,volunteer',
            'message' => 'required|string',
        ]);

        \App\Models\Inquiry::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Your inquiry has been sent successfully.'
        ], 200);
    }
}
