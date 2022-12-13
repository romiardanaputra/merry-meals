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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
