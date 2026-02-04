<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\DashboardCacheService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Partner Dashboard Controller
 * Provides optimized dashboard with cached stats
 */
class PartnerDashboardController extends Controller
{
    public function __construct(
        protected DashboardCacheService $cacheService
    ) {}

    /**
     * Display partner dashboard with optimized queries
     */
    public function index(): View|RedirectResponse
    {
        $user = auth()->user();
        $partner = $user->partner;

        // Ensure user has a partner profile
        if (! $partner) {
            return redirect()->route('partner.create');
        }

        // Get cached stats (single optimized query instead of 3 separate queries)
        $stats = $this->cacheService->getPartnerStats($partner->id);

        // Get cached trends (single optimized query instead of 7 separate queries)
        $trends = $this->cacheService->getPartnerTrends($partner->id);

        // Recent Orders with eager loading
        $orders = Order::with(['user', 'meal'])
            ->where('partnerID', $partner->id)
            ->latest()
            ->take(5)
            ->get();

        return view('features.partner.dashboard', [
            'title_page' => 'Partner Dashboard',
            'stats' => $stats,
            'orders' => $orders,
            'partner' => $partner,
            'trends' => $trends,
        ]);
    }
}
