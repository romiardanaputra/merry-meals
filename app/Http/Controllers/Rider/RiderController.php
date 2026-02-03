<?php

namespace App\Http\Controllers\Rider;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rider\UpdateDeliveryStatusRequest;
use App\Services\DashboardCacheService;
use Illuminate\Support\Facades\Auth;

/**
 * Rider (Driver) Controller
 * Handles driver dashboard, deliveries, and status updates
 */
class RiderController extends Controller
{
    public function __construct(
        protected DashboardCacheService $cacheService
    ) {}

    /**
     * Display the driver dashboard with optimized statistics
     */
    public function index(Request $request): View
    {
        $driver = Auth::user();
        $driverId = $driver->id;
        
        // Get cached stats (single optimized query instead of 4 separate queries)
        $stats = $this->cacheService->getDriverStats($driverId);
        
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
        
        // Get recent completed deliveries with eager loading
        $recentDeliveries = Order::with(['meal', 'partner', 'user'])
            ->where('volunteerID', $driverId)
            ->where('status', 'delivered')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();
        
        // Check if driver is available
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
     * Toggle driver availability status
     */
    public function toggleAvailability(Request $request): RedirectResponse
    {
        $currentStatus = session('driver_available', true);
        session(['driver_available' => !$currentStatus]);
        
        return back()->with(
            'success', 
            !$currentStatus ? 'You are now available for deliveries.' : 'You are now offline.'
        );
    }

    /**
     * Update delivery status with validated request
     */
    public function updateDeliveryStatus(UpdateDeliveryStatusRequest $request, int $id): RedirectResponse
    {
        $validated = $request->validated();
        
        $order = Order::where('id', $id)
            ->where('volunteerID', Auth::id())
            ->firstOrFail();
        
        $order->update(['status' => $validated['status']]);
        
        // Clear cache after status update
        $this->cacheService->clearOrderRelatedCaches($order);
        
        $messages = [
            'picked_up' => 'Order picked up! Head to the delivery location.',
            'in_transit' => 'Delivery in progress. Drive safely!',
            'delivered' => 'Delivery completed! Great job!',
        ];
        
        return back()->with('success', $messages[$validated['status']] ?? 'Status updated.');
    }

    /**
     * Update order (legacy method - kept for backward compatibility)
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'volunteerID' => ['nullable', 'integer', 'exists:users,id'],
            'orderStatus' => ['required', 'string'],
        ]);
        
        Order::where('id', $id)->update([
            'volunteerID' => $request->volunteerID,
            'status' => $request->orderStatus,
        ]);
        
        return back()->with('success', 'Order updated.');
    }

    /**
     * Delete an order
     */
    public function destroy(int $id): RedirectResponse
    {
        Order::where('id', $id)->delete();
        return back()->with('success', 'Order deleted.');
    }
}
