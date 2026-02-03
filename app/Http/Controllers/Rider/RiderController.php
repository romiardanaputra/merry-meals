<?php

namespace App\Http\Controllers\Rider;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RiderController extends Controller
{
    /**
     * Display the driver dashboard with statistics and active deliveries.
     */
    public function index(Request $request)
    {
        $driver = Auth::user();
        $driverId = $driver->id;
        
        // Get statistics for the driver
        $stats = [
            'assigned_today' => Order::where('volunteerID', $driverId)
                ->whereDate('created_at', today())
                ->count(),
            'in_transit' => Order::where('volunteerID', $driverId)
                ->whereIn('status', ['assigned', 'picked_up', 'in_transit'])
                ->count(),
            'completed_today' => Order::where('volunteerID', $driverId)
                ->where('status', 'delivered')
                ->whereDate('updated_at', today())
                ->count(),
            'total_deliveries' => Order::where('volunteerID', $driverId)
                ->where('status', 'delivered')
                ->count(),
        ];
        
        // Build active deliveries query with filters
        $query = Order::with(['meal', 'partner', 'user'])
            ->where('volunteerID', $driverId);
        
        // Status filter
        $statusFilter = $request->get('status', 'all');
        if ($statusFilter && $statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        } else {
            $query->whereIn('status', ['assigned', 'picked_up', 'in_transit']);
        }
        
        // Search filter (by member name or address)
        $search = $request->get('search');
        if ($search) {
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }
        
        // Paginate results (6 per page for mobile-friendly view)
        $activeDeliveries = $query->orderBy('created_at', 'desc')
            ->paginate(6)
            ->withQueryString();
        
        // Get recent completed deliveries
        $recentDeliveries = Order::with(['meal', 'partner', 'user'])
            ->where('volunteerID', $driverId)
            ->where('status', 'delivered')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();
        
        // Check if driver is available (you can store this in user table or session)
        $isAvailable = session('driver_available', true);
        
        return view('features.rider.dashboard', [
            'title_page' => 'Driver Dashboard',
            'driver' => $driver,
            'stats' => $stats,
            'activeDeliveries' => $activeDeliveries,
            'recentDeliveries' => $recentDeliveries,
            'isAvailable' => $isAvailable,
            'statusFilter' => $statusFilter,
            'search' => $search,
        ]);
    }

    /**
     * Toggle driver availability status.
     */
    public function toggleAvailability(Request $request)
    {
        $currentStatus = session('driver_available', true);
        session(['driver_available' => !$currentStatus]);
        
        return back()->with('success', !$currentStatus ? 'You are now available for deliveries.' : 'You are now offline.');
    }

    /**
     * Update delivery status (picked_up, in_transit, delivered).
     */
    public function updateDeliveryStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:picked_up,in_transit,delivered'
        ]);
        
        $order = Order::where('id', $id)
            ->where('volunteerID', Auth::id())
            ->firstOrFail();
        
        $order->update(['status' => $request->status]);
        
        $messages = [
            'picked_up' => 'Order picked up! Head to the delivery location.',
            'in_transit' => 'Delivery in progress. Drive safely!',
            'delivered' => 'Delivery completed! Great job!',
        ];
        
        return back()->with('success', $messages[$request->status] ?? 'Status updated.');
    }

    /**
     * Update order (legacy method - kept for backward compatibility).
     */
    public function update(Request $request, $id)
    {
        $order['volunteerID'] = $request->volunteerID;
        $order['status'] = $request->orderStatus;
        Order::where('id', $id)->update($order);
        return back();
    }

    /**
     * Delete an order.
     */
    public function destroy($id)
    {
        Order::where('id', $id)->delete();
        return back();
    }
}
