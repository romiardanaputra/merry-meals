<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PartnerDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $partner = $user->partner;

        // Ensure user has a partner profile
        if (!$partner) {
            return redirect()->route('partner.create');
        }

        // Stats
        $stats = [
            'total_orders' => Order::where('partnerID', $partner->id)->count(),
            'preparing' => Order::where('partnerID', $partner->id)->where('status', 'preparation')->count(),
            'completed' => Order::where('partnerID', $partner->id)->where('status', 'delivered')->count(),
            // Revenue calc could be added here later if price exists
        ];

        // Trend Data (Last 7 Days)
        $trends = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $trends[] = [
                'day' => $date->format('D'),
                'count' => Order::where('partnerID', $partner->id)
                    ->whereDate('created_at', $date->toDateString())
                    ->count()
            ];
        }

        // Recent Orders
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
            'trends' => $trends
        ]);
    }
}
