<?php

namespace App\Services;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Order Service
 * Handles business logic for order operations with transaction management
 */
class OrderService
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected DashboardCacheService $cacheService
    ) {}

    /**
     * Get all orders with optional relationships
     */
    public function getAllOrders(array $relations = []): Collection
    {
        return $this->orderRepository->all($relations);
    }

    /**
     * Get order by ID with optional relationships
     */
    public function getOrderById(int $id, array $relations = []): ?Order
    {
        $order = $this->orderRepository->find($id);
        
        if ($order && !empty($relations)) {
            $order->load($relations);
        }
        
        return $order;
    }

    /**
     * Place new order with transaction management
     */
    public function placeOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $data['status'] = Order::STATUS_PENDING;
            $order = $this->orderRepository->create($data);
            
            // Log order creation
            Log::info('Order placed', [
                'order_id' => $order->id,
                'user_id' => $data['userID'] ?? null,
                'meal_id' => $data['mealID'] ?? null,
            ]);
            
            return $order;
        });
    }

    /**
     * Get orders for a user (member) with relationships
     */
    public function getOrdersByUser(int $userId, array $relations = ['meal', 'partner']): Collection
    {
        return Order::with($relations)
            ->forUser($userId)
            ->latest()
            ->get();
    }

    /**
     * Get orders for a partner (restaurant)
     */
    public function getOrdersByPartner(int $partnerId, array $relations = ['user', 'meal']): Collection
    {
        return Order::with($relations)
            ->forPartner($partnerId)
            ->latest()
            ->get();
    }

    /**
     * Get orders for a volunteer (driver)
     */
    public function getOrdersByVolunteer(int $volunteerId, array $relations = ['user', 'meal', 'partner']): Collection
    {
        return Order::with($relations)
            ->forDriver($volunteerId)
            ->latest()
            ->get();
    }

    /**
     * Assign volunteer to order
     */
    public function assignVolunteer(int $orderId, int $volunteerId): bool
    {
        $order = Order::findOrFail($orderId);
        
        if (!$order->canTransitionTo(Order::STATUS_ASSIGNED)) {
            return false;
        }
        
        $result = $order->update([
            'volunteerID' => $volunteerId,
            'status' => Order::STATUS_ASSIGNED
        ]);
        
        // Clear affected caches
        $this->cacheService->clearOrderRelatedCaches($order);
        
        return $result;
    }

    /**
     * Update order status with state machine validation
     */
    public function updateStatus(int $orderId, string $status): bool
    {
        $order = Order::findOrFail($orderId);
        
        if (!$order->transitionTo($status)) {
            Log::warning('Invalid order status transition', [
                'order_id' => $orderId,
                'from' => $order->status,
                'to' => $status,
            ]);
            return false;
        }
        
        return true;
    }

    /**
     * Mark order as delivered
     */
    public function markAsDelivered(int $orderId): bool
    {
        return $this->updateStatus($orderId, Order::STATUS_DELIVERED);
    }

    /**
     * Get pending orders
     */
    public function getPendingOrders(array $relations = ['user', 'partner', 'meal']): Collection
    {
        return Order::with($relations)
            ->pending()
            ->latest()
            ->get();
    }

    /**
     * Get in-progress/active orders
     */
    public function getActiveOrders(array $relations = ['user', 'partner', 'meal', 'volunteer']): Collection
    {
        return Order::with($relations)
            ->active()
            ->latest()
            ->get();
    }

    /**
     * Cancel an order
     */
    public function cancelOrder(int $orderId): bool
    {
        $order = Order::findOrFail($orderId);
        
        if ($order->isFinalState()) {
            return false;
        }
        
        $order->update(['status' => Order::STATUS_CANCELLED]);
        
        return true;
    }
}
