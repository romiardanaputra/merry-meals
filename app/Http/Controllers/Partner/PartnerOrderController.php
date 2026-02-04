<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PartnerOrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $partner = $user->partner;

        if (! $partner) {
            return redirect()->route('partner.create');
        }

        $orders = Order::with(['user', 'meal'])
            ->where('partnerID', $partner->id)
            ->latest()
            ->paginate(10);

        return view('features.partner.orderList', [
            'title_page' => 'Order Management',
            'orders' => $orders,
            'partner' => $partner,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:preparation,cooking,ready,picked_up',
        ]);

        $order = Order::where('id', $id)
            ->where('partnerID', auth()->user()->partner->id)
            ->firstOrFail();

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated successfully.');
    }
}
