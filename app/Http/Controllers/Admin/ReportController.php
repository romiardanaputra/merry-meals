<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Order;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $donationStats = Donation::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(donationAmount) as total')
        )
        ->groupBy('date')
        ->orderBy('date', 'desc')
        ->limit(7)
        ->get();

        $orderStats = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        return view('features.admin.reports.index', [
            'title_page' => 'Reports & Analytics',
            'donationStats' => $donationStats,
            'orderStats' => $orderStats,
            'surveys' => Survey::with('user')->latest()->limit(10)->get(),
        ]);
    }
}
