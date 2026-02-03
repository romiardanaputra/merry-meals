<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        return view('features.admin.dashboard', [
            'title_page' => 'Admin Dashboard',
            'dashboard_info' => 'Overview Analytics',
            'donationStats' => $this->getLast7DaysDonations(),
        ]);
    }

    private function getLast7DaysDonations()
    {
        $stats = \App\Models\Donation::select(
            \Illuminate\Support\Facades\DB::raw('DATE(created_at) as date'),
            \Illuminate\Support\Facades\DB::raw('SUM(donationAmount) as total')
        )
        ->where('created_at', '>=', now()->subDays(6)->startOfDay())
        ->groupBy('date')
        ->get()
        ->pluck('total', 'date');

        $data = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $data->push([
                'date' => now()->subDays($i)->format('d M'),
                'total' => $stats->get($date, 0)
            ]);
        }

        return $data;
    }
}
