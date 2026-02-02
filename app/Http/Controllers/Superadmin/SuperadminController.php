<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Superadmin Dashboard Controller
 * Full platform management and oversight
 */
class SuperadminController extends Controller
{
    /**
     * Display the superadmin dashboard
     */
    public function index()
    {
        // Gather platform-wide statistics
        $stats = [
            'total_users' => User::count(),
            'total_members' => User::where('role', 'member')->count(),
            'total_drivers' => User::where('role', 'driver')->count(),
            'total_partners' => Partner::count(),
            'total_admins' => User::whereIn('role', ['admin', 'superadmin'])->count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', Order::STATUS_PENDING)->count(),
            'active_deliveries' => Order::whereIn('status', [
                Order::STATUS_PREPARATION,
                Order::STATUS_READY,
                Order::STATUS_ASSIGNED,
                Order::STATUS_PICKED_UP,
                Order::STATUS_IN_TRANSIT
            ])->count(),
            'delivered_orders' => Order::where('status', Order::STATUS_DELIVERED)->count(),
        ];

        // Recent activity
        $recentOrders = Order::with(['user', 'meal', 'partner', 'volunteer'])
            ->latest()
            ->take(10)
            ->get();

        // Recent users
        $recentUsers = User::latest()
            ->take(5)
            ->get();

        // Partners pending approval (if applicable)
        $pendingPartners = Partner::where('status', 'pending')
            ->with('user')
            ->take(5)
            ->get();

        // Order stats by status for chart
        $ordersByStatus = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return view('features.superadmin.dashboard', compact(
            'stats',
            'recentOrders',
            'recentUsers',
            'pendingPartners',
            'ordersByStatus'
        ));
    }

    /**
     * Display platform settings
     */
    public function settings()
    {
        return view('features.superadmin.settings');
    }

    /**
     * Update platform settings
     */
    public function updateSettings(Request $request)
    {
        // Validate and update settings
        $validated = $request->validate([
            'platform_name' => 'nullable|string|max:255',
            'support_email' => 'nullable|email|max:255',
            'max_delivery_time' => 'nullable|integer|min:30|max:180',
        ]);

        // Update settings in database or config
        // This is a placeholder - implement based on your settings storage

        return redirect()->route('superadmin.settings')
            ->with('success', 'Settings updated successfully');
    }
}
