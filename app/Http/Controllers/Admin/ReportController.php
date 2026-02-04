<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Order;
use App\Models\Survey;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('features.admin.reports.index', [
            'title_page' => 'Reports & Analytics',
            'donationStats' => $this->getLast7DaysDonations(),
            'orderStats' => Order::select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get(),
            'surveys' => Survey::with('user')->latest()->paginate(10),
        ]);
    }

    private function getLast7DaysDonations()
    {
        $stats = Donation::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(donationAmount) as total')
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
                'total' => $stats->get($date, 0),
            ]);
        }

        return $data;
    }
}
