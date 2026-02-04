<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Order;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Superadmin Report Controller
 * Platform analytics and reporting
 */
class ReportController extends Controller
{
    /**
     * Display reports dashboard
     */
    public function index()
    {
        // User stats by role
        $usersByRole = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->pluck('count', 'role')
            ->toArray();

        // Order stats by status
        $ordersByStatus = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Monthly orders trend (last 6 months)
        $monthlyOrders = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('count(*) as count')
        )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Donation stats
        $donationStats = [
            'total' => Donation::sum('donationAmount'),
            'count' => Donation::count(),
            'average' => Donation::avg('donationAmount') ?? 0,
        ];

        // Partner stats
        $partnerStats = [
            'total' => Partner::count(),
            'approved' => Partner::where('status', 'approved')->count(),
            'pending' => Partner::where('status', 'pending')->count(),
        ];

        // Top partners by orders
        $topPartners = Partner::withCount('orders')
            ->orderByDesc('orders_count')
            ->take(5)
            ->get();

        return view('features.superadmin.reports.index', compact(
            'usersByRole',
            'ordersByStatus',
            'monthlyOrders',
            'donationStats',
            'partnerStats',
            'topPartners'
        ));
    }
}
