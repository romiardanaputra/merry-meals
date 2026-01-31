<?php

namespace App\Services;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository
    ) {
    }

    /**
     * Get all orders
     */
    public function getAllOrders(): Collection
    {
        return $this->orderRepository->all();
    }

    /**
     * Get order by ID
     */
    public function getOrderById(int $id): ?Order
    {
        return $this->orderRepository->find($id);
    }

    /**
     * Place new order
     */
    public function placeOrder(array $data): Order
    {
        $data['status'] = 'pending';
        return $this->orderRepository->create($data);
    }

    /**
     * Get orders for a user (member)
     */
    public function getOrdersByUser(int $userId): Collection
    {
        return $this->orderRepository->getByUser($userId);
    }

    /**
     * Get orders for a partner (restaurant)
     */
    public function getOrdersByPartner(int $partnerId): Collection
    {
        return $this->orderRepository->getByPartner($partnerId);
    }

    /**
     * Get orders for a volunteer (rider)
     */
    public function getOrdersByVolunteer(int $volunteerId): Collection
    {
        return $this->orderRepository->getByVolunteer($volunteerId);
    }

    /**
     * Assign volunteer to order
     */
    public function assignVolunteer(int $orderId, int $volunteerId): bool
    {
        return $this->orderRepository->update($orderId, [
            'volunteerID' => $volunteerId,
            'status' => 'assigned'
        ]);
    }

    /**
     * Update order status
     */
    public function updateStatus(int $orderId, string $status): bool
    {
        return $this->orderRepository->updateStatus($orderId, $status);
    }

    /**
     * Mark order as delivered
     */
    public function markAsDelivered(int $orderId): bool
    {
        return $this->updateStatus($orderId, 'delivered');
    }

    /**
     * Get pending orders
     */
    public function getPendingOrders(): Collection
    {
        return $this->orderRepository->getByStatus('pending');
    }

    /**
     * Get in-progress orders
     */
    public function getInProgressOrders(): Collection
    {
        return $this->orderRepository->getByStatus('assigned');
    }
}
