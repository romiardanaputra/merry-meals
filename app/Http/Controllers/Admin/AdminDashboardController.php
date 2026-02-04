<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Order;
use App\Models\User;
use App\Services\DashboardCacheService;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Admin Dashboard Controller
 * Handles centralized administration analytics
 */
class AdminDashboardController extends Controller
{
    public function __construct(
        protected DashboardCacheService $cacheService
    ) {}

    /**
     * Display the main admin overview
     */
    public function index(): View
    {
        // Get cached stats to improve performance
        $stats = $this->cacheService->getAdminStats();

        // Calculate growth percentages (demo/real logic integration)
        $userGrowth = $this->calculateGrowth(User::class);
        $donationGrowth = $this->calculateGrowth(Donation::class, 'donationAmount');
        $orderGrowth = $this->calculateGrowth(Order::class);

        return view('features.admin.dashboard', [
            'title_page' => 'Admin Dashboard',
            'dashboard_info' => 'System Overview & Analytics',
            'donationStats' => $this->getLast7DaysDonations(),
            'stats' => $stats,
            'growth' => [
                'users' => $userGrowth,
                'donations' => $donationGrowth,
                'orders' => $orderGrowth,
            ],
        ]);
    }

    /**
     * Helper to calculate MoM growth
     */
    private function calculateGrowth(string $model, ?string $sumField = null): int
    {
        $currentMonth = now()->startOfMonth();
        $lastMonth = now()->subMonth()->startOfMonth();

        $currentQuery = $model::where('created_at', '>=', $currentMonth);
        $lastQuery = $model::where('created_at', '>=', $lastMonth)->where('created_at', '<', $currentMonth);

        if ($sumField) {
            $current = $currentQuery->sum($sumField);
            $last = $lastQuery->sum($sumField);
        } else {
            $current = $currentQuery->count();
            $last = $lastQuery->count();
        }

        if ($last == 0) {
            return $current > 0 ? 100 : 0;
        }

        return (int) (($current - $last) / $last * 100);
    }

    /**
     * Get donation chart data
     */
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
