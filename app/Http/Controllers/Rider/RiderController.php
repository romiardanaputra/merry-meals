<?php

namespace App\Http\Controllers\Rider;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RiderController extends Controller
{
    public function index()
    {
        return view('rider.dashboard', [
            'title_page' => 'Rider Dashboard',
            'orders' => Order::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $order['volunteerID'] = $request->volunteerID;
        $order['status'] = $request->orderStatus;
        Order::where('id', $id)->update($order);
        return back();
    }

    public function destroy($id)
    {
        Order::where('id', $id)->delete();
        return back();
    }
}
