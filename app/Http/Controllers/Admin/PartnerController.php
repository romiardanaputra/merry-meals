<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        return view('features.admin.partners.index', [
            'title_page' => 'Partner Management',
            'partners' => Partner::with('user')->get(),
        ]);
    }

    public function approve($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->update(['status' => 'approved']);
        
        return back()->with('success', 'Partner approved successfully.');
    }

    public function reject($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->update(['status' => 'rejected']);
        
        return back()->with('success', 'Partner rejected.');
    }

    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->delete();
        
        return back()->with('success', 'Partner removed successfully.');
    }
}
