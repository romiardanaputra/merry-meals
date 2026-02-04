<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('features.admin.orders.index', [
            'title_page' => 'Order Oversight',
            'orders' => Order::with(['user', 'partner', 'meal', 'volunteer'])->latest()->paginate(10),
            'volunteers' => User::where('role', User::ROLE_DRIVER)->get(),
        ]);
    }

    public function assignRider(Request $request, $id)
    {
        $request->validate([
            'volunteerID' => 'required|exists:users,id',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'volunteerID' => $request->volunteerID,
            'status' => 'assigned',
        ]);

        return back()->with('success', 'Rider assigned successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated.');
    }
}
