<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\Donation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * Service for caching dashboard statistics
 * Provides cache-optimized stats retrieval with automatic invalidation
 */
class DashboardCacheService
{
    /**
     * Cache TTL in seconds (5 minutes)
     */
    protected const CACHE_TTL = 300;

    /**
     * Get admin dashboard stats with caching
     */
    public function getAdminStats(): array
    {
        return Cache::remember(
            'admin.stats',
            self::CACHE_TTL,
            fn() => $this->calculateAdminStats()
        );
    }

    /**
     * Get partner dashboard stats with caching
     */
    public function getPartnerStats(int $partnerId): array
    {
        return Cache::remember(
            "partner.{$partnerId}.stats",
            self::CACHE_TTL,
            fn() => $this->calculatePartnerStats($partnerId)
        );
    }

    /**
     * Get driver dashboard stats with caching
     */
    public function getDriverStats(int $driverId): array
    {
        return Cache::remember(
            "driver.{$driverId}.stats",
            self::CACHE_TTL,
            fn() => $this->calculateDriverStats($driverId)
        );
    }

    /**
     * Get member dashboard stats with caching
     */
    public function getMemberStats(int $userId): array
    {
        return Cache::remember(
            "member.{$userId}.stats",
            self::CACHE_TTL,
            fn() => $this->calculateMemberStats($userId)
        );
    }

    /**
     * Calculate admin stats in a single optimized block
     */
    protected function calculateAdminStats(): array
    {
        return [
            'total_users' => User::count(),
            'total_donations' => Donation::sum('donationAmount'),
            'total_orders' => Order::count(),
            'delivered_orders' => Order::where('status', 'delivered')->count(),
            'active_volunteers' => User::where('role', 'volunteer')->count(),
            'today_orders' => Order::whereDate('created_at', today())->count(),
        ];
    }

    /**
     * Calculate partner stats in a single optimized query
     */
    protected function calculatePartnerStats(int $partnerId): array
    {
        $stats = Order::where('partnerID', $partnerId)
            ->selectRaw("
                COUNT(*) as total_orders,
                SUM(CASE WHEN status = 'preparation' THEN 1 ELSE 0 END) as preparing,
                SUM(CASE WHEN status = 'delivered' THEN 1 ELSE 0 END) as completed
            ")
            ->first();

        return [
            'total_orders' => $stats->total_orders ?? 0,
            'preparing' => $stats->preparing ?? 0,
            'completed' => $stats->completed ?? 0,
        ];
    }

    /**
     * Calculate driver stats in a single optimized query
     */
    protected function calculateDriverStats(int $driverId): array
    {
        $stats = Order::where('volunteerID', $driverId)
            ->selectRaw("
                SUM(CASE WHEN DATE(created_at) = CURDATE() THEN 1 ELSE 0 END) as assigned_today,
                SUM(CASE WHEN status IN ('assigned', 'picked_up', 'in_transit') THEN 1 ELSE 0 END) as in_transit,
                SUM(CASE WHEN status = 'delivered' AND DATE(updated_at) = CURDATE() THEN 1 ELSE 0 END) as completed_today,
                SUM(CASE WHEN status = 'delivered' THEN 1 ELSE 0 END) as total_deliveries
            ")
            ->first();

        return [
            'assigned_today' => $stats->assigned_today ?? 0,
            'in_transit' => $stats->in_transit ?? 0,
            'completed_today' => $stats->completed_today ?? 0,
            'total_deliveries' => $stats->total_deliveries ?? 0,
        ];
    }

    /**
     * Calculate member stats in a single optimized query
     */
    protected function calculateMemberStats(int $userId): array
    {
        $stats = Order::where('userID', $userId)
            ->selectRaw("
                COUNT(*) as total_orders,
                SUM(CASE WHEN status IN ('assigned', 'picked_up') THEN 1 ELSE 0 END) as active_deliveries,
                SUM(CASE WHEN status = 'delivered' THEN 1 ELSE 0 END) as delivered_orders
            ")
            ->first();

        $surveyCount = \App\Models\Survey::where('userID', $userId)->count();

        return [
            'total_orders' => $stats->total_orders ?? 0,
            'active_deliveries' => $stats->active_deliveries ?? 0,
            'delivered_orders' => $stats->delivered_orders ?? 0,
            'pending_surveys' => max(0, ($stats->delivered_orders ?? 0) - $surveyCount),
        ];
    }

    /**
     * Get partner trends (last 7 days) with caching
     */
    public function getPartnerTrends(int $partnerId): array
    {
        return Cache::remember(
            "partner.{$partnerId}.trends",
            self::CACHE_TTL,
            fn() => $this->calculatePartnerTrends($partnerId)
        );
    }

    /**
     * Calculate partner trends in a single query
     */
    protected function calculatePartnerTrends(int $partnerId): array
    {
        $trends = Order::where('partnerID', $partnerId)
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');

        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $data[] = [
                'day' => $date->format('D'),
                'count' => $trends->get($date->format('Y-m-d'), 0)
            ];
        }

        return $data;
    }

    /**
     * Clear all admin caches
     */
    public function clearAdminCache(): void
    {
        Cache::forget('admin.stats');
    }

    /**
     * Clear partner cache
     */
    public function clearPartnerCache(int $partnerId): void
    {
        Cache::forget("partner.{$partnerId}.stats");
        Cache::forget("partner.{$partnerId}.trends");
    }

    /**
     * Clear driver cache
     */
    public function clearDriverCache(int $driverId): void
    {
        Cache::forget("driver.{$driverId}.stats");
    }

    /**
     * Clear member cache
     */
    public function clearMemberCache(int $userId): void
    {
        Cache::forget("member.{$userId}.stats");
    }

    /**
     * Clear all caches related to an order
     */
    public function clearOrderRelatedCaches(Order $order): void
    {
        $this->clearAdminCache();
        
        if ($order->partnerID) {
            $this->clearPartnerCache($order->partnerID);
        }
        if ($order->volunteerID) {
            $this->clearDriverCache($order->volunteerID);
        }
        if ($order->userID) {
            $this->clearMemberCache($order->userID);
        }
    }
}
