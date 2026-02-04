<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

/**
 * Superadmin Partner Management Controller
 * Handles partner approval, rejection, and management
 */
class PartnerController extends Controller
{
    /**
     * Display list of all partners
     */
    public function index(Request $request)
    {
        $query = Partner::with('user')->latest();

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $partners = $query->paginate(15);

        return view('features.superadmin.partners.index', compact('partners'));
    }

    /**
     * Display specific partner details
     */
    public function show(Partner $partner)
    {
        $partner->load(['user', 'geolocation']);

        return view('features.superadmin.partners.show', compact('partner'));
    }

    /**
     * Approve partner application
     */
    public function approve(Partner $partner)
    {
        $partner->update(['status' => 'approved']);

        return redirect()->back()
            ->with('success', "Partner '{$partner->restaurantName}' has been approved.");
    }

    /**
     * Reject partner application
     */
    public function reject(Partner $partner)
    {
        $partner->update(['status' => 'rejected']);

        return redirect()->back()
            ->with('success', "Partner '{$partner->restaurantName}' has been rejected.");
    }

    /**
     * Suspend active partner
     */
    public function suspend(Partner $partner)
    {
        $partner->update(['status' => 'suspended']);

        return redirect()->back()
            ->with('success', "Partner '{$partner->restaurantName}' has been suspended.");
    }

    /**
     * Remove partner from database
     */
    public function destroy(Partner $partner)
    {
        $partnerName = $partner->restaurantName;
        $partner->delete();

        return redirect()->route('superadmin.partners.index')
            ->with('success', "Partner '{$partnerName}' has been deleted.");
    }
}
