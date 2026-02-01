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
            'partner' => $partner
        ]);
    }
}
