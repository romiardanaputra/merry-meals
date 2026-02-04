<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Superadmin Order Management Controller
 * Full order oversight and management
 */
class OrderController extends Controller
{
    /**
     * Display list of all orders with filters
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'meal', 'partner', 'volunteer'])->latest();

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->has('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $orders = $query->paginate(15);
        $statuses = Order::getStatuses();
        $drivers = User::where('role', 'driver')->get();

        return view('features.superadmin.orders.index', compact('orders', 'statuses', 'drivers'));
    }

    /**
     * Display specific order details
     */
    public function show(Order $order)
    {
        $order->load(['user', 'meal', 'partner', 'volunteer']);

        return view('features.superadmin.orders.show', compact('order'));
    }

    /**
     * Assign driver to order
     */
    public function assignDriver(Request $request, Order $order)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:users,id',
        ]);

        $driver = User::findOrFail($validated['driver_id']);

        if ($driver->role !== 'driver') {
            return redirect()->back()
                ->with('error', 'Selected user is not a driver.');
        }

        $order->update([
            'volunteerID' => $driver->id,
            'status' => Order::STATUS_ASSIGNED,
        ]);

        return redirect()->back()
            ->with('success', "Driver '{$driver->name}' assigned to order #{$order->id}.");
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:'.implode(',', Order::getStatuses()),
        ]);

        if (! $order->canTransitionTo($validated['status'])) {
            return redirect()->back()
                ->with('error', "Cannot transition from '{$order->status}' to '{$validated['status']}'.");
        }

        $order->transitionTo($validated['status']);

        return redirect()->back()
            ->with('success', "Order status updated to '{$validated['status']}'.");
    }

    /**
     * Cancel order
     */
    public function cancel(Order $order)
    {
        if ($order->isFinalState()) {
            return redirect()->back()
                ->with('error', 'Cannot cancel an order that is already completed or cancelled.');
        }

        $order->update(['status' => Order::STATUS_CANCELLED]);

        return redirect()->back()
            ->with('success', "Order #{$order->id} has been cancelled.");
    }
}
