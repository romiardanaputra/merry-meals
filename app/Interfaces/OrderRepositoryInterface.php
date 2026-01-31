<?php

namespace App\Interfaces;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryInterface
{
    /**
     * Get all orders
     */
    public function all(): Collection;

    /**
     * Find order by ID
     */
    public function find(int $id): ?Order;

    /**
     * Create new order
     */
    public function create(array $data): Order;

    /**
     * Update order
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete order
     */
    public function delete(int $id): bool;

    /**
     * Get orders by user ID
     */
    public function getByUser(int $userId): Collection;

    /**
     * Get orders by partner ID
     */
    public function getByPartner(int $partnerId): Collection;

    /**
     * Get orders by status
     */
    public function getByStatus(string $status): Collection;

    /**
     * Get orders by volunteer ID
     */
    public function getByVolunteer(int $volunteerId): Collection;

    /**
     * Update order status
     */
    public function updateStatus(int $id, string $status): bool;
}
